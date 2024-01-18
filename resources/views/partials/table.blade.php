<table id="openTable" class="table table-striped" style="width:100%">
    {{-- <thead>
        <tr>
            <th> Assignee </th>
            <th> Subject </th>
            <th> Status </th>
            <th> Submitted </th>
            <th> Tracking ID </th>
            <th> Info Ticket</th>
        </tr>
    </thead> --}}
    <tbody>
        @if ($ticket->where('status', 'Open')->isEmpty())
            <p class="text-center">There is no data</p>
        @else
            @foreach ($ticket as $t)
                @if ($t->status == 'Open')
                    <tr>
                        <td>{{ $t->name_user }}</td>
                        <td>{{ $t->subject }}</td>
                        <td>
                            <label class="badge badge-gradient-info">{{ $t->status }}</label>
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

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    setInterval(function() {
        location.href = "{{ route('refresh.table') }}";
    }, 1000);

    setInterval(function() {
        location.href = "{{ route('refresh.table_progress') }}";
    }, 1000);

    setInterval(function() {
        location.href = "{{ route('refresh.table_pending') }}";
    }, 1000);

    setInterval(function() {
        location.href = "{{ route('refresh.table_solved') }}";
    }, 1000);
</script> --}}
