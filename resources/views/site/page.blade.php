@extends('layouts.blog-layout')

@section('title', $item->title ?? 'Page')

@section('seo')
<x-seo-meta 
        :title="$item->title"
        :description="$item->meta_description ?: $item->description"
        type="article"
        :keywords="$item->meta_keywords"
    />
@endsection
@section('content')




  <!-- Post content + Sharing -->
  <section class="container mb-5 pt-4 pb-2 py-mg-4">
    <div class="row gy-4">
      <!-- Content -->


      @if($item->hasImage('cover'))
                <img src="{{ $item->image('cover') }}" alt="{{ $item->imageAltText('cover') }}" />
            @endif

            <h1>{{ $item->h1_header ?: $item->title }}</h1>
            
            @if($item->description)
                <div class="text-gray-700 mb-6 leading-relaxed">
                    {!! $item->description !!}
                </div>
            @endif

            @if($item->content)
                <div class="content-area mb-8">
                    {!! $item->content !!}
                </div>
            @endif
        </div>

        {!! $item->renderBlocks() !!}



    </div>
  </section>
@endsection

