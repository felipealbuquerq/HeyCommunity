@extends('layouts.default')

@section('title')
    关于 - {{ $system->site_title }}
@endsection

@section('mainBody')
    <div id="section-site" class="page-site-about">
        <div class="container pt-4">
            <div class="row">
                <div class="col-lg-3 col-md-3 m-np">
                    @include('site._sidebar')
                </div>

                <div class="col-lg-9 col-md-9 m-np">
                    <div id="sitepage-card" class="card">
                        <div class="card-body">
                            <h4 class="card-title">关于 {{ $system->site_title }}</h4>
                            <h6 class="card-subtitle text-muted">{{ $system->site_subheading }}</h6>

                            <div class="mt-3">
                                <p>
                                    <em>HEY赣州</em> 是一个立足于赣州的本地化线上社区。我们是一个信息平台，为用户提供优质及时的本地新闻资讯与全面实时的本地活动信息。
                                    同时，我们也是一个社交平台，通过话题栏目与社区朋友们进行深度地交流，通过动态栏目把你发现的有趣事物和社区的朋友们一起分享。 <br>
                                </p>

                                <p>
                                    优质的内容是我们平台立足的根本，良好的用户体验和用户至上的理念贯穿平台运营的始终，以及探索美好发现美好的理想主义情怀，相信你和我们一样会喜爱这里。 <br>
                                </p>

                                <p>
                                    在未来，我们会涉足电商、招聘、分类信息等领域，为您提供优质的地本化服务。
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 d-block d-md-none m-np mt-4">
                    @include('layouts._tail')
                </div>
            </div>
        </div>
    </div>
@stop

