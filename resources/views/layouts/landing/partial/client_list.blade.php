<table class="table">
    <thead>
    <tr>
        <th>번호</th>
        <th>등록일</th>
        <th>업체명</th>
        <th>관리자명</th>
        <th>관리자 번호</th>
        <th>업체 아이디</th>
        <th>상태</th>
    </tr>
    </thead>
    <tbody>
    @foreach($clients as $client)
        <tr>
            <td>{{$client->id}}</td>
            <td>{{$client->created_at}}</td>
            <td>{{$client->c_name}}</td>
            <td>{{$client->m_name}}</td>
            <td>{{$client->phone}}</td>
            <td>{{$client->c_id}}</td>
            <td>{{$client->status}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<div id="client-list-pagination" class="text-center">
    {{$clients->links()}}
</div>