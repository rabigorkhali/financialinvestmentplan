<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
<table>
    <thead>
    <tr>
        <th>S.N</th>
        <th>Username</th>
        <th>IP</th>
        <th>City</th>
        <th>Country</th>
        <th>ISP</th>
        <th>LAT</th>
        <th>LON</th>
        <th>Timezone</th>
        <th>Region Name</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $key=>$item)
        <tr>
            <td>{{$key + 1}}</td>
            <td>{{isset($item->user) ? $item->user->username : 'N/A'}}</td>
            <td>{{$item->ip ?? 'N/A'}}</td>
            <td>{{$item->city ?? 'N/A'}}</td>
            <td>{{$item->country ?? 'N/A'}}</td>
            <td>{{$item->isp ?? 'N/A'}}</td>
            <td>{{$item->lat ?? 'N/A'}}</td>
            <td>{{$item->lon ?? 'N/A'}}</td>
            <td>{{$item->timezone ?? 'N/A'}}</td>
            <td>{{$item->region_name ?? 'N/A'}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
