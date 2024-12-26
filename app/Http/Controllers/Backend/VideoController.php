<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Http\Services\VideoService;
use App\Http\Controllers\Controller;
use App\Http\Requests\VideoRequest;

class VideoController extends Controller
{
    public function __construct(
        private VideoService $videoService
        ){}

    public function index()
    {
        return view('backend.video.index', [
            'videos' => $this->videoService->select(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.video.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VideoRequest $request)
    {
        $data = $request->only(['name', 'description', 'link']);

        try {
            $this->videoService->create($data);
            return redirect()->route('panel.video.index')->with('success', 'Video has been created');
        } catch (\Exception $error) {
            return redirect()->back()->with('error', $error->getMessage());
        }

        }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        return view('backend.video.show', [
            'video' => $this->videoService->selectFirstBy('uuid', $uuid)
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        return view('backend.video.edit', [
            'video' => $this->videoService->selectFirstBy('uuid', $uuid)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VideoRequest $request, string $uuid)
    {
        $data = $request->validated();

        try {
            $getVideo = $this->videoService->selectFirstBy('uuid', $uuid);
            $this->videoService->update($data, $uuid);

            return redirect()->route('panel.video.index')->with('success', 'Video has been updated');
        } catch (\Exception $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }
    }


    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(string $uuid)
    {
        $getVideo = $this->videoService->selectFirstBy('uuid', $uuid);

        $getVideo->delete();

        return response()->json([
            'message' => 'Image has been deleted'
        ]);
    }
}
