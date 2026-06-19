@foreach($data->messages as $message)
    <x-chat::influencer.message :$message :$data />
@endforeach
