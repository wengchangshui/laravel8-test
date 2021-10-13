<?php
/**
 * FileName: PostController.php
 * Description: 填写该类功能描述
 * @author: 翁昌水
 * @Create Date: 2021/10/13 16:08
 * @version v1.0
 */


namespace Order\Controllers;


use App\Models\Post;
use App\Repos\PostRepo;
use Illuminate\Support\Facades\Redis;

class PostController
{
    protected $postRepo;

    public function __construct(PostRepo $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    // 浏览文章
    public function show($id)
    {
        $post = $this->postRepo->getById($id);
        $views = $this->postRepo->addViews($post);
        return "Show Post #{$post->id}, Views: {$views}";
    }

    // 获取热门文章排行榜
    public function popular()
    {
        $posts = $this->postRepo->trending(10);
        if ($posts) {
            dump($posts->toArray());
        }
    }
}
