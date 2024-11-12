<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{

    public function destroy($id)
    {
        $this->authorize('delete', Attachment::class);
        $attachment = Attachment::findOrFail($id);
        try {
            Storage::delete($attachment->file_path);
            $attachment->delete();
            return redirect()->back()->with('success', 'Attachment deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }
    }

}
