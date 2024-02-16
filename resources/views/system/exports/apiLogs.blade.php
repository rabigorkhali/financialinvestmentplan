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
        <th>{{translate("S.N")}}</th>
        <th>{{translate("IP")}}</th>
        <th>{{translate('Log Date')}}</th>
        <th style="width: 30%;">{{translate('User Agent')}}</th>
        <th style="width: 30%;">{{translate('Request End Point')}}</th>
        <th style="width: 30%;">{{translate('Response Code')}}</th>
        <th style="width: 30%;">{{translate('Response Time')}}</th>
        <th style="width: 30%;">{{translate('Request Body')}}</th>
        <th style="width: 30%;">{{translate('Response Body')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $key=>$item)
        <tr>
            <td>{{$key + 1}}</td>
            <td>{{$item->ip ?? 'N/A'}}</td>
            <td>{{$item->log_date ?? 'N/A'}}</td>
            <td>{{$item->user_agent ?? 'N/A'}}</td>
            <td>{{$item->request_endpoint ?? 'N/A'}}</td>
            <td>{{$item->response_code ?? 'N/A'}}</td>
            <td>{{$item->response_time ?? 'N/A'}}</td>
            <td>{{$item->request_body ?? 'N/A'}}</td>
            <td>{{$item->response_body ?? 'N/A'}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
