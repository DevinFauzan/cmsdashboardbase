
    @foreach ($ticket as $t)
        @if ($t->status == 'Progress')
            <tr>
                <td>{{ $t->name_user }}</td>
                <td>{{ $t->name_tech }}</td>
                <td>{{ $t->subject }}</td>
                <td>
                    <label class="badge badge-gradient-warning">{{ $t->status }}</label>
                </td>
                <td>{{ $t->created_at->format('Y-m-d') }}</td>
                <td>{{ $t->ticket_id }}</td>
            </tr>
        @endif
    @endforeach

