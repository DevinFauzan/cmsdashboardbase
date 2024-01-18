<div class="table-responsive">
    <table class="table" id="techPersonTable">
        <tbody>
            <tbody>
                <tr>
                    <td colspan="6" class="text-center">There is no data</td>
                </tr>
            </tbody>
            @foreach ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->name_user }}</td>
                    <td>{{ $ticket->subject }}</td>
                    <td>
                        <label class="card-description badge badge- text-black">
                            @switch($ticket->status)
                                @case('Open')
                                    <label class="badge badge-info">Open</label>
                                @break

                                @case('Progress')
                                    <label class="badge badge-warning">Progress</label>
                                @break

                                @case('Pending')
                                    <label class="badge badge-danger">Pending</label>
                                @break

                                @case('Solved')
                                    <label class="badge badge-success">Solved</label>
                                @break

                                @default
                                    <label class="badge badge-secondary">Unknown</label>
                            @endswitch
                        </label>
                    </td>
                    <td>{{ $ticket->updated_at }}</td>
                    <td>{{ $ticket->ticket_id }}</td>
                    <td>
                        <a href="{{ route('detail_ticket.edit', ['id' => $ticket->id]) }}"
                            class="btn btn-info bg-gradient-info">
                            <span class="mdi mdi-details"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>