<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddCart extends Component
{
    public $article;
    #[Validate('required|min:1|max:20')]
    public $quantity = 1;

    public function mount($article)
    {
        $this->article = $article;
    }

    public function getTotalPriceProperty()
    {
        if (!$this->quantity) return 0;
        return $this->article->price * $this->quantity;
    }

    public function addToCart()
    {
        $this->validate(); // Validazione della quantità tra 1 e 20

        $user = Auth::user();

        // Verifica se l'utente ha già un carrello
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        // Verifica se l'articolo è già presente nel carrello dell'utente
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('article_id', $this->article->id)
            ->first();

        // Limite massimo per quantità
        $maxQuantity = 20;
        // Verifica se la quantità richiesta supera lo stock disponibile
        if ($this->quantity > $this->article->stock) {
            session()->flash('message', 'Non ci sono abbastanza articoli in stock!');
            return;
        }


        if ($cartItem) {
            // Se l'articolo esiste, aggiorna la quantità
            $newQuantity = $cartItem->quantity + $this->quantity;

            // Assicurati che la quantità non superi il limite massimo
            if ($newQuantity <= $maxQuantity) {
                $cartItem->quantity = $newQuantity;
                $cartItem->save();
            } else {
                session()->flash('message', 'Non puoi aggiungere più di ' . $maxQuantity . ' articoli al carrello!');
                return;
            }
        } else {
            // Se l'articolo non esiste, creane uno nuovo
            if ($this->quantity <= $maxQuantity) {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'article_id' => $this->article->id,
                    'quantity' => $this->quantity,
                    'price' => $this->article->price,
                ]);
            } else {
                session()->flash('message', 'Non puoi aggiungere più di ' . $maxQuantity . ' articoli al carrello!');
                return;
            }
        }
        return redirect('articles')->with('message', 'Articolo aggiunto al carrello!');
    }

    public function render()
    {
        return view('livewire.add-cart');
    }
}
