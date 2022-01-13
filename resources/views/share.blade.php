<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="og:title" content="{{ $article->title }}"/>
    <meta property="og:site_name" content="{{ $site }}"/>
    <meta property="og:description" content="{{ $article->description }}"/>
    <meta property="og:image" itemprop="image" content="{{ $article->image_url }}"/>
    <meta property="og:image:url"  itemprop="image" content="{{ $article->image_url }}"/>
    <meta property="og:image:alt" content="{{ $site }}"/>
    <meta property="og:image:width" content="100"/>
    <meta property="og:image:height" content="100"/>
    <meta property="og:image:type" content="image/*"/>
    <meta property="article:published_time" content="<?= date_format(date_create($article->created_at), 'Y-m-d') ?>"/>
    <meta property="article:author" content="{{ $site }}"/>
    <meta property="article:section" content="{{ $site }}"/>
    <meta property="article:tag" content="{{ $site }}"/>
    <link rel="icon" href="{{asset('asset/logo-avesma-10.png')}}" type="image/x-icon" />
    <title>{{ $site }}</title>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
</head>
<body>
    <script>
        window.location.href = "{{ $url }}";
    </script>
</body>
</html>