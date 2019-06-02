<?php

namespace App\Http\Controllers;

use App\DaiLy;
use App\SanPham;
use App\SP_LoSX;
use App\STT_LoSX;
use GuzzleHttp\Exception\ClientException;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use QR_Code\QR_Code;
use Illuminate\Support\Facades\Crypt;


class TaoQRCodeController extends Controller
{
    //
    public function getDanhSach(){
        $sp_losx = SP_LoSX::all();
        return view('admin.taoqrcode.danhsach',['sp_losx'=>$sp_losx]);
    }

    public function getChiTiet($MaLo,$MaSP){

        $stt_losx = DB::select( DB::raw("select distinct MaLo,MaSP,MaDL from stt_losx where MaLo = '$MaLo' and MaSP = '$MaSP' order by STT ASC ") );
        foreach ($stt_losx as $stt){
            $daily = DaiLy::where('MaDL',$stt->MaDL)->first();
            $TenDL[$stt->MaDL] = $daily->TenDL;
            $TenSP = SanPham::where('MaSP',$MaSP)->first()->TenSP;

            $trangthai = STT_LoSX::where('MaLo',$MaLo)->where('MaSP',$MaSP)->where('MaDL',$stt->MaDL)->first();
            // Nếu đã in thì không hiển thị hình ảnh
            if($trangthai->trangthai < 1){
                $directory ='upload/qrcode/'.$MaLo.'/'.$MaSP;
                $image[$stt->MaDL]=glob($directory .'/'.$stt->MaDL."/*.png");
            }
            else $image[$stt->MaDL] = array(null);

        }
        return view('admin.taoqrcode.chitiet',['stt_losx'=>$stt_losx,'TenDL'=>$TenDL ,'image'=>$image,'TenSP'=>$TenSP]);
    }

    public function getTaoMa($MaLo ,$MaSP){
        if(file_exists('upload'.DIRECTORY_SEPARATOR.'qrcode'.DIRECTORY_SEPARATOR.$MaLo.DIRECTORY_SEPARATOR.$MaSP)){
            return redirect('admin/chitiet/'.$MaLo.'/'.$MaSP);
        }

        // Tạo file MaLo
        $path_MaLo = public_path('upload'.DIRECTORY_SEPARATOR.'qrcode'.DIRECTORY_SEPARATOR.$MaLo);
        if(!file_exists($path_MaLo)){
            \Illuminate\Support\Facades\File::makeDirectory($path_MaLo,0775,true);
        }
        // Tạo file MaSP
        $path_MaSP = $path_MaLo.DIRECTORY_SEPARATOR.$MaSP;
        if(!file_exists($path_MaSP)){
            \Illuminate\Support\Facades\File::makeDirectory($path_MaSP,0775,true);
        }

        // Lấy thông tin SP_LoSX
        $sp_losx = SP_LoSX::where('MaLo',$MaLo)->where('MaSP',$MaSP)->first();
        $SDK = $sp_losx->motsanpham->SDK;
        $NSX = $sp_losx->NSX->format('d/m/Y');
        $HSD = $sp_losx->HSD->format('d/m/Y');

        $MaDL = DB::select( DB::raw("select distinct MaDL from stt_losx where MaLo = '$MaLo' and MaSP = '$MaSP' order by STT ASC ") );
        foreach ($MaDL as $madl){
            //Tạo file MaDL
            $path_MaDL = $path_MaSP.DIRECTORY_SEPARATOR.$madl->MaDL;
            if(!file_exists($path_MaDL)){
                \Illuminate\Support\Facades\File::makeDirectory($path_MaDL,0775,true);
            }

            $stt_losx = STT_LoSX::where('MaLo',$MaLo)->where('MaSP',$MaSP)->where('MaDL',$madl->MaDL)->get();
            foreach ($stt_losx as $stt){

                //Tạo QR CODE
                $data['MaLo'] = $MaLo;
                $data['MaSP'] = $MaSP;
                $data['STT'] = $stt->STT;
                $data_qrcode = json_encode($data);
                $data_qrcode = Crypt::encrypt($data_qrcode);

                $maQR['DN'] = env('APP_DOMAIN');
                $maQR['Data'] = $data_qrcode;
                $maQR_qrcode = json_encode($maQR);

                $path_png = $path_MaDL.DIRECTORY_SEPARATOR.$stt->STT.'.png';
                QR_Code::png($maQR_qrcode,$path_png,0,2,1);

                //Tạo canvas
                $img = Image::canvas(300,100);
                $img->text('SĐK:        '.$SDK, 110, 7 , function($font) {
                    $font->file('fonts/arial.ttf');
                    $font->size(15);
                    $font->color('#000000');
                    $font->valign('top');
                });
                $img->text('Số lô SX:       '.$MaLo, 110, 30 , function($font) {
                    $font->file('fonts/arial.ttf');
                    $font->size(15);
                    $font->color('#000000');
                    $font->valign('top');
                });
                $img->text('NSX:        '.$NSX, 110, 57 , function($font) {
                    $font->file('fonts/arial.ttf');
                    $font->size(15);
                    $font->color('#000000');
                    $font->valign('top');
                });
                $img->text('HSD:        '.$HSD, 110, 82 , function($font) {
                    $font->file('fonts/arial.ttf');
                    $font->size(15);
                    $font->color('#000000');
                    $font->valign('top');
                });

                // Tạo thông tin đi kèm mã QR
                $qrcode = Image::make($path_png)->resize(100,100);
                $img_qr = $img;
                $img_qr->insert($qrcode,'left');
                $img_qr->save($path_png);
            }
        }
        return redirect('admin/chitiet/'.$MaLo.'/'.$MaSP);
    }

    public function getInMa($MaLo,$MaSP,$MaDL){
        //$stt_losx = STT_LoSX::where('MaLo',$MaLo)->where('MaSP',$MaSP)->where('MaDL',$MaDL)->first();
        // Nếu đã in thì không cho in nữa
        //if($stt_losx->trangthai >= 1) return \response("",404);

        //DB::update("UPDATE stt_losx SET trangthai = 1 where MaLo='$MaLo' and MaSP='$MaSP' and MaDL='$MaDL'");

        $directory ='upload/qrcode/'.$MaLo.'/'.$MaSP;
        $image=glob($directory .'/'.$MaDL."/*.png");
        return view('admin.taoqrcode.inma',['image'=>$image]);
    }

    public function getInMaSTT($MaLo, $MaSP, $MaDL, $STT){

        $directory ='upload/qrcode/'.$MaLo.'/'.$MaSP;
        $image=glob($directory .'/'.$MaDL.'/'.$STT.".png");
        return view('admin.taoqrcode.inma',['image'=>$image]);
    }
}

