<div>
    <div class="d-flex flex-column justify-content-between" style="height: 400px;">
        <div class="messages">
            @foreach ($messages as $message)
                <div
                    class="message p-2 rounded mb-2 
                @if ($message['user'] === (auth()->user()->name ?? 'Utente')) bg-chat-user
                @elseif($message['user'] === 'Willy') bg-chat-ai 
                @else bg-danger text-white @endif">
                    <strong>{{ $message['user'] }}:</strong> {{ $message['message'] }}
                </div>
            @endforeach
        </div>

        <div class="input-container d-flex justify-content-between align-items-center gap-2" id="input-chat">
            <input type="text" wire:model="newMessage" placeholder="Scrivi un messaggio..." class="form-control"
                style="width: 100%; padding: 8px;" id="input-message" />
            <button type="button" wire:click="sendMessage" class="btn btn-custom" id="send-message">Invia</button>
        </div>
    </div>
</div>
