<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Utilities\Resources;
use Exception;

trait ImageTrait
{

    /**
     * Devuelve el nuevo nombre del archivo, estado, mensaje
     *
     * Este método se utiliza reducir el tamaño de una imagen,
     * cambiandole el formado webp
     *
     */
    public function webpImage(Request $request, $input_name, $model, $id)
    {
        $path = storage_path('app/public') . "/$model/$id/";
        if ($request->hasFile($input_name)) {
            try {
                $file = $request->file($input_name);
                $rand = strtolower(Str::random(10));
                $image = Image::make($file);
                $image->encode('webp', 90);

                // Create folder directory and save
                Storage::disk('public')->makeDirectory($model . '/' . $id);
                $image->save($path . $rand . '.webp');
                return [
                    'response' => ['status' => true, 'name' => $rand, 'message' => 'Se ha guardado con éxito']
                ];
            } catch (\Exception $ex) {
                return [
                    'response' => ['status' => false, 'name' => $ex->getMessage(), 'message' => $ex->getMessage()]
                ];
            }
        }
    }

    public function send_file(Request $request, string $input_name, string $model, int $id): array
    {
        $path = storage_path('app/public') . "/$model/$id/";
        $doc_path = "$model/$id/";

        try {
            if (Resources::isImagen($request->file($input_name)->getMimeType())){
                if ($request->hasFile($input_name)) {
                    $file = $request->file($input_name);
                    $rand = strtolower(Str::random(10));
                    $image = Image::make($file);
                    $image->encode('webp', 90);

                    // Create folder directory and save
                    Storage::disk('public')->makeDirectory($model . '/' . $id);
                    $image->save($path . $rand . '.webp');

                    $url = "{$model}/{$id}/{$rand}.webp";
                }
            } else {
                $uid = uniqid();
                $file = $request->file($input_name);
                $ext = $file->getClientOriginalExtension();
                $filename_parsed = "$uid.$ext";
                
                $file->move(storage_path('app/public') . "/$model/$id/", $filename_parsed);
                $url = "$model/$id/$filename_parsed";
            }

            return [
                'response' => ['success' => true, 'payload' => $url]
            ];
        } catch (Exception $ex) {
            return [
                'response' => ['success' => false, 'payload' => $ex->getMessage()]
            ];
        }
    }

    public function update_file(Request $request, string $input_name, string $model, int  $id, string $url): array
    {
        try {
            // $url_file = DialogueTable::query()->whereId($id)->value($input_name);
            Storage::disk('public')->delete($url);
            $response = $this->send_file($request, $input_name, $model, $id);
            return $response;
        } catch (Exception $ex) {
            return [
                'response' => ['success' => false, 'payload' => $ex->getMessage()]
            ];
        }
    }
}
