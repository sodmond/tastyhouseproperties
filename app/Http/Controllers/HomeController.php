<?php

namespace App\Http\Controllers;

use App\Mail\ContactForm;
use App\Models\Advert;
use App\Models\Blog;
use App\Models\City;
use App\Models\Newsletter;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Seller;
use App\Models\State;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { #dd(url('/'));
        $adverts = Advert::all();
        $primeProducts = Product::where('prime_status', 1)->inRandomOrder()->take(24)->get();
        $recentProducts = Product::orderByDesc('created_at')->take(20)->get();
        $plugview = DB::table('api_data')->where('name', 'plugview')->get()->keyBy('token_type');
        return view('home', compact('adverts', 'primeProducts', 'recentProducts', 'plugview'));
    }

    public function getCitiesforState($state_id)
    {
        $state = State::find($state_id);
        if (!$state) {
            return response()->json(['error' => 'Not found'], 404);
        }
        $cities = City::where('state_id', $state->id)->orderBy('name')->get();
        return response()->json(['cities' => $cities], 200);
    }

    public function about()
    {
        return view('about');
    }

    public function faq()
    {
        return view('faq');
    }

    public function contact()
    {
        return view('contact');
    }

    public function contactForm(Request $request)
    {
        $this->validate($request, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:rfc,dns', 'max:255'],
            'phone' => ['required', 'numeric'],
            'message' => ['required', 'string', 'max:1500'],
            'g-recaptcha-response' => ['recaptcha'],
        ],[
            'recaptcha' => 'You need to complete the recaptcha field'
        ]);
        try {
            Mail::to('info@tastyhousestores.com')->send(new ContactForm($request->except(['_token', 'g-recaptcha-response'])));
            return back()->with('success', 'Contact form has been submitted, we will get back to you shortly.');
        } catch(\Exception $e) {
            Log:info($e->getMessage());
            return back()->withErrors(['err_msg' => 'Unable to submit contact form, pls try again.']);
        }
    }

    public function tandc()
    {
        return view('terms_conditions');
    }

    public function privacyPolicy()
    {
        return view('privacy_policy');
    }

    public function getSubCategories($cat_id)
    {
        $category = ProductCategory::find($cat_id);
        if (!$category) {
            return response()->json(['error' => 'No record found'], 400);
        }
        $sub_categories = ProductCategory::where('parent', $category->id)->orderBy('title')->get();
        return response()->json(['categories' => $sub_categories]);
    }

    public function newsletter(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email:rfc,dns', 'unique:newsletters'],
            'g-recaptcha-response' => ['recaptcha']
        ]);
        try {
            $newsletter = Newsletter::where('email', $request->email);
            if(! isset($newsletter->email)) {
                Newsletter::create([
                    'email' => $request->email
                ]);
            }
            return back()->with('newsletter_suc', 'You have just subscribed to our newsletter');
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return back();
        }
    }

    public function advertise()
    {
        $adverts = Advert::where('end_date', '<', date('Y-m-d'))->get();
        return view('advertise', compact('adverts'));
    }

    public function advertiseForm(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:rfc,dns', 'max:255'],
            'phone' => ['required', 'numeric'],
            'banner' => ['required', 'string', 'max:1500'],
            'duration' => ['required', 'string', 'max:1500'],
            'g-recaptcha-response' => ['recaptcha'],
        ],[
            'recaptcha' => 'You need to complete the recaptcha field'
        ]); #dd($request->except(['_token', 'g-recaptcha-response']));
        try {
            Mail::to('advertise@tastyhousestores.com')->send(new ContactForm($request->except(['_token', 'g-recaptcha-response'])));
            return back()->with('success', 'Form has been submitted, we will get back to you shortly.');
        } catch(\Exception $e) {
            Log:info($e->getMessage());
            return back()->withErrors(['err_msg' => 'Unable to submit contact form, pls try again.']);
        }
    }
}
