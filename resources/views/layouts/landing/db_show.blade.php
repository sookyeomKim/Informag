@extends('layouts.marster')
@section('styles')
    <link rel="stylesheet" href="{{elixir('css/db-show.css')}}">
@endsection
@section('content')
    <aside class="col-md-2">
        <dl>
            @if($roleCheck)
                <dt><a class="btn btn-default" href="{{url('landing/create')}}">추가</a></dt>
            @endif
        </dl>
    </aside>
    <div class="col-md-10">
        <div>
            <h1>DB리스트</h1>
        </div>
        <section>
            <h2>선택된 랜딩 페이지</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>등록일</th>
                        <th>업체명</th>
                        <th>제목</th>
                        <th>담당자</th>
                        <th>시작일</th>
                        <th>종료일</th>
                        <th>조회수</th>
                        <th>DB수</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$lan_info->created_at}}</td>
                        <td>{{$lan_info->lan_c_name}}</td>
                        <td>{{$lan_info->lan_title}}</td>
                        <td>{{$lan_info->lan_m_name}}</td>
                        <td>{{$lan_info->lan_start_date}}</td>
                        <td>{{$lan_info->lan_end_date}}</td>
                        <td></td>
                        <td>{{$lan_info->db_manage_fields->count()}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <section class="well">
            <h2>URL조회수</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>등록일</th>
                        <th>URL</th>
                        <th>조회수</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($url_info as $info)
                        <tr>
                            <td>{{$info->id}}</td>
                            <td>{{$info->lan_url}}</td>
                            <td>{{$info->hits}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        <section class="well">
            <form class="form-horizontal" method="get" action="{{route('DbManageField.show',$lan_info->id)}}">
                <div class="form-group">
                    <div class="input-daterange">
                        <div class="col-sm-2">
                            {{--http://link2me.tistory.com/755--}}
                            <input type="text" class="form-control" id="db-start-date" name="db_start_date" readonly=""
                                   value="{{date("Y-m-d")}}">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="db-end-date" name="db_end_date" readonly=""
                                   value="{{date("Y-m-d",mktime(0,0,0,date("m")+6,date("d"),date("Y")))}}">
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <select class="form-control" id="db-title-select" name="db_title_select">
                            @foreach($db_info as $info)
                                <option value="{{$info->lan_db_title}}">{{$info->lan_db_title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="db-search-text" name="db_search_text"
                               value="">
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-default">검색</button>
                    </div>
                    <div class="col-sm-2">
                        <a href="{{route('DbManageField.excelExport',$lan_info->id)}}" class="btn btn-default">엑셀저장</a>
                    </div>
                </div>
            </form>
        </section>
        {{--{{$test}}--}}
        <section class="well">
            <h2>DB리스트</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        @foreach($db_info as $info)
                            <th>{{$info->lan_db_title}}</th>
                        @endforeach
                        <th>등록일</th>
                        <th>유입URL</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($db_list as $item)
                        <tr>
                            @foreach($item->db_content as $value)
                                <td>{{$value}}</td>
                            @endforeach
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->db_inflow}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-center">
                {{$db_list->links()}}
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script src="{{elixir('js/db-show.js')}}"></script>
    <script>
        $('.input-daterange').datepicker({
            todayBtn: "linked",
            language: "ko",
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    </script>
@endsection