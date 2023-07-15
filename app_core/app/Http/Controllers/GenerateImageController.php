<?php

namespace App\Http\Controllers;

use App\Enums\EnumImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class GenerateImageController extends Controller
{
    /**
     * 画像生成フォームの表示
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('generate.image.index');
    }

    public function downloadImage(Request $request)
    {
        $size = $request->input('filesize');
        $extension = EnumImage::from($request->input('extension'))->getExtension();

        // ファイルサイズ制限用のバイト数を計算
        $limitSize = $size * 1024 * 1024 -3000;

        // 画像生成
        $image = Image::canvas(100, 100, '#000000');
        $image->text("Generated Image", 50, 50, function ($font) {
            // $font->file(public_path('fonts/monaco.ttf'));
            $font->size(12);
            $font->color('#ffffff');
            $font->align('center');
            $font->valign('middle');
        });

        // $tempPath = sprintf('%s.%s', tempnam(sys_get_temp_dir(), 'image'), $extension);
        $tempPath = storage_path('app/public/downloaded/image.' . $extension);

        // 生成した画像のファイルサイズを取得
        $generatedSize = $this->getImageFileSize($image, $extension, $tempPath);

        // ファイルサイズの差分を計算
        $sizeDiff = $limitSize - $generatedSize;

        // ファイルサイズの差分を反映するために再保存
        $this->saveImage($image, $tempPath, $extension);
        $this->adjustFileSize($tempPath, $extension, $sizeDiff);

        // ダウンロード処理
        return view('generate.image.index');
    }

    private function getImageFileSize($image, $extension, $path)
    {
        ob_start();

        // 一時的に保存してファイルサイズを取得
        $this->saveImage($image, $path, $extension);

        $data = ob_get_contents();

        ob_end_clean();

        return strlen($data);
    }

    private function adjustFileSize($tempPath, $extension, $sizeDiff)
    {
        // ファイルの現在のサイズを取得
        $currentSize = filesize($tempPath);

        // ファイルサイズの差分が指定のファイルサイズを超えていた場合、削る処理を行う
        if ($sizeDiff > 0) {
            // 削るバイト数を計算
            $bytesToRemove = $currentSize - $sizeDiff;
            Log::info($bytesToRemove);

            // ファイルを読み込み、末尾のバイト数を削除する
            $fileContent = file_get_contents($tempPath);
            $fileContentTrimmed = substr($fileContent, 0, -$bytesToRemove);

            // 削った内容をファイルに保存する
            file_put_contents($tempPath, $fileContentTrimmed);
        }

        // ファイルサイズの差分が0以下の場合は何もしない
        if ($sizeDiff <= 0) {
            return;
        }

        // ファイルサイズの差分を埋めるためのダミーデータを生成
        $dummyData = str_repeat('0', $sizeDiff);

        // ダミーデータをファイルに追加して再保存
        file_put_contents($tempPath, $dummyData, FILE_APPEND);
    }

    private function saveImage($image, $path, $extension, $quality = 100)
    {
        // 保存処理を拡張子に応じて行う
        switch ($extension) {
            case 'jpg':
            case 'png':
            case 'gif':
            case 'svg':
            case 'tif':
            case 'bmp':
            case 'ico':
            case 'psd':
            case 'webp':
            case 'jpeg':
                $image->save($path, $quality);
                break;
            default:
                throw new \InvalidArgumentException("Unsupported extension: $extension");
        }
    }
}
