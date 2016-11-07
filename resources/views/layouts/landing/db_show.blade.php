@extends('layouts.marster')
@section('content')
    <aside class="col-md-2">
        <dl>
            <dt><a class="btn btn-default" href="">추가</a></dt>
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
                        <th>조회사</th>
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
                        <th>제목</th>
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
            검색
        </section>
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
                                @foreach($value as $val)
                                    <td>{{$val}}</td>
                                @endforeach
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

