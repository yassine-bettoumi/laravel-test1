<?php 
namespace App\Traits;
Trait PdfTrait {
    protected function savePdf($pdfFile,$folder){
        $file_extension = $request->pdfFile->getClientOriginalExtension(); // to get the extension
        if($file_extension = 'pdf'){
            $checkProposalifExist = $pdfFile->pdfService->searchFor('proposal');
            if($checkProposalifExist){
                $file_name = time().'.'.$file_extension; // i added the time to make the name unique
                $path = $folder;
                $request -> pdfFile ->move($path,$file_name); // to move the file to the relevent path
                return $file_name;
            }else{
                return '403'; // file doesn't contain the word proposal

            }
         }
         else{
               return '422'; // file is not pdf
         }
    }
}
