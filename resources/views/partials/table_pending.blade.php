<table id="pendingTable" class="table table-striped" style="width:100%">
    <tbody>
        @if ($ticket->where('status', 'Pending')->isEmpty())
        <tbody>
            <tr>
                <td colspan="6" class="text-center">There is no data</td>
            </tr>
        </tbody>
        @else
            @foreach ($ticket as $t)
                @if ($t->status == 'Pending')
                    <tr>
                        <td>{{ $t->name_user }}</td>
                        <td>{{ $t->name_tech }}</td>
                        <td>{{ $t->subject }}</td>
                        <td>
                            <label class="badge badge-gradient-danger">{{ $t->status }}</label>
                        </td>
                        <td>{{ $t->created_at }}</td>
                        <td>{{ $t->ticket_id }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm mdi-24px text-white"
                                onclick="window.location.href='{{ route('admin_ticket_detail.edit', ['id' => $t->id]) }}'">
                                Info
                            </button>
                        </td>
                    </tr>
                @endif
            @endforeach
        @endif
    </tbody>
</table>
