@extends('layouts.marster')
@section('content')
    <aside class="col-md-2 static-aside">
        <dl>
            @if($roleCheck)
                <dt><a class="active">목록</a></dt>
                <dt><a href="{{url('landing/create')}}">추가</a></dt>
            @endif
        </dl>
    </aside>
    <section class="col-md-10">
        <h2>랜딩 페이지 목록</h2>
        <div>
            <p>수정하려면 제목을, 수집된 DB를 확인하려면 DB수 항목을 클릭하세요</p>
            <!-- 검색 -->
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <form class="navbar-form">
                            <div class="form-inline">
                                <input type="date" name="startDt" class="form-control" max="1979-12-31"> -
                                <input type="date" name="endDt" class="form-control" min="2000-01-02">
                                <button type="submit" class="btn btn-default">조회</button>
                                <select class="form-control">
                                    <option>업체명</option>
                                    <option>제목</option>
                                    <option>담당자</option>
                                </select>
                                <input type="text" class="form-control" placeholder="Search">
                                <button type="submit" class="btn btn-default">검색</button>
                                <select class="form-control">
                                    <option>10개씩 보기</option>
                                    <option>20개씩 보기</option>
                                    <option>30개씩 보기</option>
                                </select>
                                <p class="badge text-right">총 221개</p>
                            </div>
                        </form>
                    </div>
                </div><!-- /.navbar-collapse -->
            </nav>

            <div class="tablebox">
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
            </div>
        <div class="text-center">
            {{$landings->links()}}
        </div>
    </section>
@endsection
