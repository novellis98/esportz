<?php

namespace App\Http\Controllers;

use App\Mail\MailContact;
use App\Mail\SendAutoEmail;
use App\Models\Article;
use App\Models\Order;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PublicController extends Controller
{
    public function homepage()
    {
        return view('homepage');
    }
    public function earnings()
    {
        // Calcola il guadagno totale
        $orders = Order::all();
        $totalEarnings = $orders->sum('total');

        // Calcola l'articolo più acquistato
        $mostPurchasedItem = DB::table('order_items')
            ->select('article_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('article_id')
            ->orderByDesc('total_quantity')
            ->limit(1)
            ->first();

        // Recupera il nome dell'articolo più acquistato
        $mostPurchasedItemDetails = null;
        if ($mostPurchasedItem) {
            $mostPurchasedItemDetails = DB::table('articles')
                ->where('id', $mostPurchasedItem->article_id)
                ->first();
        }

        // Calcola il cliente più attivo
        $mostActiveCustomer = DB::table('orders')
            ->select('user_id', DB::raw('COUNT(*) as total_orders'))
            ->groupBy('user_id')
            ->orderByDesc('total_orders')
            ->limit(1)
            ->first();

        $mostActiveUser = DB::table('users')->find($mostActiveCustomer->user_id);
        $mostActiveUser->name;

        // Recupera il nome del cliente più attivo
        $mostActiveCustomerDetails = null;
        $totalSpentByCustomer = 0;
        if ($mostActiveCustomer) {
            $mostActiveCustomerDetails = DB::table('users')
                ->where('id', $mostActiveCustomer->user_id)
                ->first();

            // Calcola il totale speso dal cliente più attivo
            $totalSpentByCustomer = DB::table('orders')
                ->where('user_id', $mostActiveCustomer->user_id)
                ->sum('total');
        }

        // Trova l'utente con il maggior numero di recensioni
        $mostActiveReviewer = DB::table('reviews')
            ->select('user_id', DB::raw('COUNT(*) as total_reviews'))
            ->groupBy('user_id')
            ->orderByDesc('total_reviews')
            ->limit(1)
            ->first();
        // Recupera i dettagli dell'utente con il maggior numero di recensioni
        $mostActiveReviewerDetails = null;
        if ($mostActiveReviewer) {
            $mostActiveReviewerDetails = DB::table('users')
                ->where('id', $mostActiveReviewer->user_id)
                ->first();
        }

        // Ottieni l'anno e il mese corrente
        $year = now()->year;
        $month = now()->month;

        // Recupera gli ordini per il mese corrente, raggruppati per data
        $dailyEarnings = DB::table('orders')
            ->select(DB::raw('DATE(created_at) as order_date'), DB::raw('SUM(total) as total_earnings'))
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get();

        // Recupera gli ordini per ogni giorno (opzionale)
        $dailyOrders = DB::table('orders')
            ->select(DB::raw('DATE(created_at) as order_date'), DB::raw('COUNT(*) as total_orders'))
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get();

        // Prepara i dati per passare alla vista
        $dailyData = [];
        foreach ($dailyEarnings as $earning) {
            $dailyData[$earning->order_date] = [
                'earnings' => $earning->total_earnings,
                // 'orders' => $dailyOrders->where('order_date', $earning->order_date)->first()->total_orders ?? 0,
            ];
        }
        // Passa i dati alla vista
        return view('earnings', compact('orders', 'totalEarnings', 'mostPurchasedItemDetails', 'mostPurchasedItem', 'mostActiveCustomerDetails', 'totalSpentByCustomer', 'mostActiveReviewerDetails', 'mostActiveReviewer', 'dailyData', 'mostActiveUser'));
    }

    public  function contattaci()
    {
        return view('contattaci');
    }
    public function userEdit()
    {
        return view('profile.edit');
    }


    public function contactUs(Request $request)
    {
        // Validazione dei dati inviati dal form
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);
        // Preparazione dei dati per l'email
        $userData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'message' => $validatedData['message'],
        ];
        try {
            // Invio dell'email a te
            // Mail::to(env('MAIL_FROM_ADDRESS')) // L'indirizzo di destinazione
            //     ->send(new MailContact($userData));
            Mail::to(env('MAIL_FROM_ADDRESS')) // L'indirizzo di destinazione
                ->send(new MailContact($userData));
            // Invio dell'email di conferma all'utente
            Mail::to($validatedData['email']) // L'email dell'utente
                ->send(new SendAutoEmail($userData)); // Puoi creare una vista separata per la risposta automatica
            return redirect(route('homepage'))->with('success', 'Email inviata con successo!');
        } catch (Exception $error) {
            dd($error);
            return redirect(route('homepage'))->with('emailError', 'Errore durante l\'invio della email');
        }
    }
}
