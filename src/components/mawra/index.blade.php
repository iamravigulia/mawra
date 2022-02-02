<style>
    table {
        background: #fff;
        width: 100%;
        border: 0;
    }
    th {}
    td {
        border-top: 1px solid #999;
        padding: 5px;
    }
    tr:nth-child(odd) {
        background: #ddd;
    }
</style>
<table>
    <thead>
        <th>#</th>
        <th>Question</th>
        <th>Answers</th>
        <th>Created at</th>
        <th>Updated at</th>
    </thead>
    <tbody>
        @php
        $fmt_mof_ques = DB::table('fmt_mof_ques')->get();
        @endphp
        @foreach ($fmt_mof_ques as $que)
        <tr>
            <td>{{$que->id}}</td>
            <td>{{$que->question}}</td>
            <td>
                @php $fmt_mof_ans = DB::table('fmt_mof_ans')->where('question_id', $que->id)->orderby('arrange','asc')->get() @endphp
                <ul>
                    @foreach ($fmt_mof_ans as $ans)
                    <li>{{$ans->answer}}</li>
                    @endforeach
                </ul>
            </td>
            <td>{{date('F d, Y',strtotime($que->created_at))}}</td>
            <td>{{date('F d, Y',strtotime($que->updated_at))}}</td>
        </tr>
        <x-mof.edit :message="$que->id"/>
        @endforeach
    </tbody>
</table>
<script>
    function modalMOF($id){
        var modal = document.getElementById('modalMOF'+$id);
        modal.classList.remove("hidden");
    }
    function closemodalMOF($id){
        var modal = document.getElementById('modalMOF'+$id);
        modal.classList.add("hidden");
    }
</script>