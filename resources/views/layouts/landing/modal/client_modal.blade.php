<div class="modal fade" id="c-name-modal" tabindex="-1" role="dialog" aria-labelledby="c-name-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="c-name-modal">업체명 선택</h4>
            </div>
            <div class="modal-body">
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
                    </tbody>
                </table>
                <div class="text-center">
                    {{$clients->links()}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="client-table-copy">
    <table class="client-table">
        <tr>
            <td class="client-num"></td>
            <td class="client-creat-date"></td>
            <td class="client-c-name"></td>
            <td class="client-m-name"></td>
            <td class="client-m-phone"></td>
            <td class="client-c-id"></td>
            <td class="client-m-status"></td>
        </tr>
    </table>
</div>
