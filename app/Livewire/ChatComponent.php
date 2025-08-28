<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Order;
use App\Models\Review;
use Exception;
use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ChatComponent extends Component
{
    public $messages = [];
    public $newMessage = '';
    public $articles;
    public $reviews;
    public $orders;

    public function mount()
    {
        // Carica gli articoli e le recensioni
        $this->articles = Article::all();
        $this->reviews = Review::all();

        // Controlla se l'utente è loggato prima di caricare gli ordini
        if (Auth::check()) {
            $this->orders = Order::where('user_id', Auth::id())->get();
        } else {
            $this->orders = collect(); // Ritorna una collection vuota se non è loggato
        }
    }

    public function sendMessage()
    {
        if (trim($this->newMessage) === '') {
            return;
        }

        // Converti i dati in JSON per evitare problemi di concatenazione
        $articlesJson = $this->articles->toJson();
        $reviewsJson = $this->reviews->toJson();
        $ordersJson = $this->orders->toJson();

        // Prompt per OpenAI
        $systemPrompt = "Sei un assistente virtuale che si chiama Willy e aiuti gli utenti a scegliere quale articolo comprare nell'e-commerce. 
            Gli articoli disponibili sono: $articlesJson. 
            Le recensioni sono: $reviewsJson. 
            Gli ordini effettuati dall'utente sono: $ordersJson. 
            Se ti chiedono cose che non riguardano e-commerce, articoli, recensioni o ordini, rispondi che non rientra nelle tue competenze.
            Rispondi con tono allegro e non troppo formale.";

        try {
            // Aggiungi il messaggio dell'utente alla chat
            $this->messages[] = [
                'user' => Auth::user()->name ?? 'Utente',
                'message' => $this->newMessage
            ];

            // Invia il messaggio a OpenAI
            $response = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user', 'content' => $this->newMessage],
                ],
            ]);

            // Aggiungi la risposta di Willy alla chat
            $this->messages[] = [
                'user' => 'Willy',
                'message' => $response->choices[0]->message->content ?? 'Non ho capito la domanda, puoi riformularla?'
            ];
        } catch (Exception $e) {
            Log::error('Errore OpenAI: ' . $e->getMessage());

            // Mostra un messaggio di errore in chat
            $this->messages[] = [
                'user' => 'System',
                'message' => 'Errore nella richiesta. Riprova più tardi.'
            ];
        }

        // Pulisce il campo di input
        $this->newMessage = '';
    }

    public function render()
    {
        return view('livewire.chat-component');
    }
}
