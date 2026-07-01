@include('errors.layout', [
    'code' => '403',
    'title' => 'Access Forbidden',
    'message' => 'You are not authorized to access this resource. Your account does not have the required permission.'
])