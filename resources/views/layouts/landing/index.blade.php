@extends('layouts.marster')
@section('content')
    <aside class="col-md-2">
        <dl>
            @if($roleCheck)
                <dt><a class="btn btn-default" href="{{url('landing/create')}}">추가</a></dt>
            @endif
        </dl>
    </aside>
    <section class="col-md-10">
        <div>
            <h1>랜딩 페이지 목록</h1>
        </div>
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
                    <th>진행여부</th>
                    <th>조회수</th>
                    <th>DB수</th>
                </tr>
                </thead>
                <tbody>
                @foreach($landings as $landing)
                    <tr>
                        <td>{{$landing->created_at}}</td>
                        <td>{{$landing->lan_c_name}}</td>
                        @if($roleCheck)
                            <td><a href="{{route('landing.edit',$landing->id)}}">{{$landing->lan_title}}</a></td>
                        @else
                            <td><a href="{{route('DbManageField.show',$landing->id)}}">{{$landing->lan_title}}</a></td>
                        @endif
                        <td>{{$landing->lan_m_name}}</td>
                        <td>{{$landing->lan_start_date}}</td>
                        <td>{{$landing->lan_end_date}}</td>
                        <td>
                            <button type="button" class="btn btn-default">진행 중</button>
                            <button type="button" class="btn btn-default">종료</button>
                        </td>
                        <td></td>
                        @if($roleCheck)
                            <td>
                                <a href="{{route('DbManageField.show',$landing->id)}}">{{$landing->db_manage_fields->count()}}</a>
                            </td>
                        @else
                            <td>{{$landing->db_manage_fields->count()}}</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">
            {{$landings->links()}}
        </div>
    </section>
@endsection

{{--
<a href="javascript:window.open({{'"'.route('landing.show',$landing->title).'"'}},{{'"'.$landing->title.'"'}},'width=768','top=0')"
   target="_blank">{{route('landing.show',$landing->title)}}</a>--}}
