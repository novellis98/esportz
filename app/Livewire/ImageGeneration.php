<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Review;
use Exception;
use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ImageGeneration extends Component
{
    public $messages = [];
    public $newMessage = '';
    public $articles;
    public $reviews;

    public function mount()
    {
        // Carica gli articoli e le recensioni
        $this->articles = Article::all();
        $this->reviews = Review::all();
    }

    public function sendMessage()
    {
        if (trim($this->newMessage) === '') {
            return;
        }

        $articlesJson = $this->articles->toJson();
        $reviewsJson = $this->reviews->toJson();

        $systemPrompt = "Se l'utente chiede di generare un'immagine, fornisci una descrizione dettagliata dell'immagine da creare. Gli articoli disponibili sono: $articlesJson. Le recensioni sono: $reviewsJson.";

        try {
            $this->messages[] = [
                'user' => Auth::user()->name ?? 'Utente',
                'message' => $this->newMessage
            ];

            // Controlliamo se il messaggio richiede un'immagine
            if (preg_match('/(immagine|disegna|mostrami|visualizza)/i', $this->newMessage)) {
                $imagePrompt = "Un'illustrazione dettagliata basata su questa richiesta: " . $this->newMessage;

                $imageResponse = OpenAI::images()->create([
                    'model' => 'dall-e-3',
                    'prompt' => $imagePrompt,
                    'n' => 1,
                    'size' => '1024x1024',
                    'response_format' => 'url',
                ]);
                // Debugging della risposta
                Log::info('Risposta immagine: ', ['response' => $imageResponse]);

                $imageUrl = $imageResponse->data[0]->url ?? null;

                if ($imageUrl) {
                    $this->messages[] = [
                        'user' => 'Willy',
                        'message' => 'Ecco l\'immagine che ho generato per te!',
                        'image' => $imageUrl
                    ];
                } else {
                    $this->messages[] = [
                        'user' => 'Willy',
                        'message' => 'Non sono riuscito a generare l\'immagine. Riprova con una descrizione più dettagliata!'
                    ];
                }
            }
        } catch (Exception $e) {
            Log::error('Errore OpenAI: ' . $e->getMessage());

            $this->messages[] = [
                'user' => 'System',
                'message' => 'Errore nella richiesta. Riprova più tardi.'
            ];
        }

        $this->newMessage = '';
    }

    public function render()
    {
        return view('livewire.image-generation');
    }
}
