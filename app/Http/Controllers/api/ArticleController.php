<?php

namespace App\Http\Controllers\api;

use App\Models\Article;
use App\Http\Resources\ArticleResource;
use App\Http\Requests\ArticleLightRequest;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    use apiResponseTrait;
    public function create(ArticleLightRequest $request)
    {
        DB::beginTransaction();
        try {
            $item = Article::create([
                'title->ar' =>  $request->title_ar,
                'slug->ar'  =>  $request->slug_ar,
                'body->ar'  =>  $request->body_ar,

                'title->en' =>  $request->title_en,
                'slug->en'  =>  $request->slug_en,
                'body->en'  =>  $request->body_en,

                'title->ca' =>  $request->title_ca,
                'slug->ca'  =>  $request->slug_ca,
                'body->ca'  =>  $request->body_ca,
            ]);
            DB::commit();
            if ($item) {
                return $this->apiResponse('Record created', [], $item, [], 201);
            } else {
                return $this->apiResponse('Application error please try again', [], $item, [], 400);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->apiResponse('Application error please try again', [], $th, [], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function record($id, $lang)
    {
        $item = Article::where('state', '!=', 'delete')->where('id', $id)->first();

        // check for return data
        if ($item) {
            $item['lang'] = $lang;
            return $this->apiResponse('Record', [], new ArticleResource($item), [], 200);
            // return error record not found
        } else {
            return $this->apiResponse('This record not found', [], [], [], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function records($lang)
    {
        $items = Article::where('state', '!=', 'delete')->get();
        foreach ($items as $key => $item) {
            $item['lang'] = $lang;
        }
        return $this->apiResponse('records', [], ArticleResource::collection($items), [], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function recordslang()
    {
        $items = Article::where('state', '!=', 'delete')->get();

        return $this->apiResponse('records', [], $items, [], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id, $key)
    {
        date_default_timezone_set('Africa/Cairo');
        $data = Article::where('state', '!=', 'delete')->where('id', $id)->first();

        if ($data) {
            $data->update([
                'title' => [$key =>  $request->title],
                'slug' => [$key =>  $request->slug],
                'body' => [$key =>  $request->body],
            ]);
            return $this->apiResponse('✔ update success', [], $data, [], 200);
        } else {
            return $this->apiResponse('Error', [], [], [], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $data = Article::where('id', $id)->update(['state' => 'delete']);
            DB::commit();
            if ($data) {
                return $this->apiResponse('Record deleted', [], [], 201);
            } else {
                return $this->apiResponse('Error', [], $data, [], 400);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->apiResponse('Error', [], $th, [], 400);
        }
    }
}
