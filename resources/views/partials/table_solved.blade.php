@if ($ticket->where('status', 'Solved')->isEmpty())
    <tr>
        <td colspan="6" class="text-center">There is no progress data</td>
    </tr>
@else
    @foreach ($ticket as $t)
        @if ($t->status == 'Solved')
            <tr>
                <td>{{ $t->name_user }}</td>
                <td>{{ $t->name_tech }}</td>
                <td>{{ $t->subject }}</td>
                <td>
                    <label class="badge badge-gradient-success">{{ $t->status }}</label>
                </td>
                <td>{{ $t->created_at->format('Y-m-d') }}</td>
                <td>{{ $t->ticket_id }}</td>
            </tr>
        @endif
    @endforeach
@endif
