<table>
    <tr>
        <td>Bil</td>
        <td>Title</td>
        <td>Category</td>
        <td>Owner</td>
    </tr>
    @foreach ($events as $event)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $event->title }}</td>
        <td>{{ $event->eventCategory->category }}</td>
        <td>{{ $event->owner->name }}</td>
    </tr>
    @endforeach
</table>



