<table id="client-list-table" class="table">
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
            <td class="client-num">{{$client->id}}</td>
            <td class="client-create-date">{{$client->created_at}}</td>
            <td class="client-c-name">{{$client->c_name}}</td>
            <td class="client-m-name">{{$client->m_name}}</td>
            <td class="client-m-phone">{{$client->phone}}</td>
            <td class="client-c-id">{{$client->c_id}}</td>
            <td class="client-m-status">{{$client->status}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<div id="client-list-pagination" class="text-center">
    {{$clients->links()}}
</div>