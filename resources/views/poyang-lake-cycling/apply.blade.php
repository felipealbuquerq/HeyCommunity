@extends('poyang-lake-cycling.layout')

@section('title')
    报名
@endsection

@section('description')
@endsection

@section('mainBody')
    <div id="section-mainbody" class="page-news-index">
        <div class="container pt-4">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="h4 mt-4 text-center">
                        填写报名信息 <small>(1/3)</small>
                    </h1>
                    <p class="text-center">
                        请如实填写以下报名信息，不正确的信息将会影响您的比赛和意外保险保障。
                    </p>

                    <form class="mt-4" action="{{ route('poyang-lake-cycling.apply-handle') }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="input-name" class="col-sm-2 col-form-label">姓名</label>
                            <div class="col-sm-10">
                                <input name="name" type="text" class="form-control" id="input-name" value="{{ old('name') }}">

                                <div class="text-danger">{{ $errors->first('name') }}</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input-identity_card_number" class="col-sm-2 col-form-label">身份证号码</label>
                            <div class="col-sm-10">
                                <input name="identity_card_number" type="text" class="form-control" id="input-identity_card_number" value="{{ old('identity_card_number') }}">

                                <div class="text-danger">{{ $errors->first('identity_card_number') }}</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input-phone" class="col-sm-2 col-form-label">手机号码</label>
                            <div class="col-sm-10">
                                <input name="phone" type="text" class="form-control" id="input-phone" value="{{ old('phone') }}">

                                <div class="text-danger">{{ $errors->first('phone') }}</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input-club_name" class="col-sm-2 col-form-label">俱乐部名称</label>
                            <div class="col-sm-10">
                                <input name="club_name" type="text" class="form-control" id="input-club_name" value="{{ old('club_name') }}">

                                <div class="text-danger">{{ $errors->first('club_name') }}</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input-gender_id" class="col-sm-2 col-form-label">性别</label>
                            <div class="col-sm-10">
                                <select name="gender_id" type="text" class="form-control" id="input-gender_id">
                                    <option value="0">请选择</option>
                                    <option value="1">男性</option>
                                    <option value="2">女性</option>
                                </select>

                                <div class="text-danger">{{ $errors->first('gender_id') }}</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input-group_id" class="col-sm-2 col-form-label">组别</label>
                            <div class="col-sm-10">
                                <select name="group_id" type="text" class="form-control" id="input-group_id">
                                    <option value="0">请选择</option>
                                    <option value="1">业余男子公路组</option>
                                    <option value="2">业余男子山地青年组</option>
                                    <option value="3">业余男子山地壮年组</option>
                                    <option value="4">业余山地女子组</option>
                                </select>

                                <div class="text-muted">
                                    请按性别/年龄/车型选择正确的组别 <br>
                                    青年 xxxxx 壮年 xxx <br>
                                    女性仅能报业余山地女子组
                                </div>
                                <div class="text-danger">{{ $errors->first('group_id') }}</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input-is_shangyou_people" class="col-sm-2 col-form-label">是否上犹籍</label>
                            <div class="col-sm-10">
                                <select name="is_shangyou_people" type="text" class="form-control" id="input-is_shangyou_people">
                                    <option value="0">否</option>
                                    <option value="1">是</option>
                                </select>

                                <div class="text-muted">用于本地组名次，请如实填写</div>
                                <div class="text-danger">{{ $errors->first('is_shangyou_people') }}</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <button class="btn btn-primary btn-block">提交报名</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
