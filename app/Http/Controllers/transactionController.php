<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Models\pet;
use App\Models\Service;
use App\Models\employee;
use App\Models\transac;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class transactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::rightJoin(
            "pets",
            "pets.customer_id",
            "=",
            "customers.id"
        )
            ->rightjoin(
                "transacs",
                "transacs.pets_id",
                "=",
                "pets.id"
            )
            ->leftjoin(
                "services",
                "services.id",
                "=",
                "transacs.service_id"
            )
            ->leftjoin(
                "employees",
                "employees.id",
                "=",
                "transacs.employee_id"
            )
            ->select(
                "transacs.id",
                "customers.full_name",
                "pets.pet_name",
                "services.service_name",
                "employees.full_name",
                "transacs.date",
                "transacs.status",
            )

            ->orderBy("transacs.id", "ASC")
            ->withTrashed()
            ->paginate(6);
        return view("transac.index", [
            "customers" => $customers,
        ]);
    }

    public function getInfo()
    {
        $pets = pet::join(
            "customers",
            "customers.id",
            "=",
            "pets.customer_id"
        )
            ->join(
                "kind",
                "kind.id",
                "=",
                "pets.kind_id"
            )
            ->select(
                "customers.full_name",
                "pets.id",
                "pets.pet_name",
                "pets.sex",
                "kind.kind",
                "pets.pictures",
                "pets.customer_id",
                "pets.deleted_at"
            )
            ->get();
        $services = Service::all();
        return view("transac.info", [
            "services" => $services,
            "pets" => $pets,
        ]);
    }

    public function getCart()
    {
        if (!Session::has("cart")) {
            return view("transac.shopping-cart");
        }
        $oldService = Session::get("cart");
        $cart = new Cart($oldService);
        return view("transac.shopping-cart", [
            "services" => $cart->services,
            "pets" => $cart->pets,
            "totalCost" => $cart->totalCost,
        ]);
    }

    public function getAddToCart(Request $request, $id)
    {
        $services = Service::find($id);
        $oldService = Session::has("cart")
            ? $request->session()->get("cart")
            : null;
        $cart = new Cart($oldService);
        $cart->add($services, $services->id);
        $request->session()->put("cart", $cart);
        Session::put("cart", $cart);
        $request->session()->save();
        return redirect()->route("info");
    }

    public function getPet(Request $request, $id)
    {
        $pets =  pet::find($id);
        $oldService = Session::has("cart")
            ? $request->session()->get("cart")
            : null;
        $cart = new Cart($oldService);
        $cart->addPet($pets, $pets->id);
        $request->session()->put("cart", $cart);
        Session::put("cart", $cart);
        $request->session()->save();
        return redirect()->route("info");
    }

    public function getRemoveItem($id)
    {
        $oldCart = Session::has("cart") ? Session::get("cart") : null;
        $cart = new Cart($oldCart);
        $cart->removeService($id);
        if (count($cart->services) > 0) {
            Session::put("cart", $cart);
        } else {
            Session::forget("cart");
        }
    }

    public function removeService($id)
    {
        $this->totalCost -= $this->services[$id]["cost"];
        unset($this->services[$id]);
        unset($this->pets[$id]);
    }

    public function postCheckout(Request $request)
    {
        if (!Session::has("cart")) {
            return redirect()->route("transaction.index");
        }
        $oldCart = Session::get("cart");
        $cart = new Cart($oldCart);
        try {
            DB::beginTransaction();
            foreach ($cart->services as $services) {
                foreach ($cart->pets as $pets) {
                    $id = $services["services"]["id"];
                    $pets_id = $pets["pets"]["id"];
                    DB::table("transacs")->insert([
                        "employee_id" => Auth::id(),
                        "service_id" => $id,
                        "pets_id" => $pets_id,
                        "created_at" => now(),
                        "updated_at" => now(),
                        "date" => now(),
                    ]);
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->route("transaction.shoppingCart")
                ->with("error", $e->getMessage());
        }
        DB::commit();
        Session::forget("cart");
        return redirect()->route("receipt");
    }

    public function getReceipt()
    {
        $customers = Customer::rightJoin(
            "pets",
            "pets.customer_id",
            "=",
            "customers.id"
        )
            ->rightjoin(
                "transacs",
                "transacs.pets_id",
                "=",
                "pets.id"
            )
            ->leftjoin(
                "services",
                "services.id",
                "=",
                "transacs.service_id"
            )
            ->select(
                "customers.full_name",
                "pets.pet_name",
                "services.service_name",
                "services.cost",
                "transacs.id",
                "customers.deleted_at"
            )

            ->orderBy("transacs.id", "DESC")
            // ->where("transacs.id")
            ->latest("transacs.id")
            ->take("6")
            ->get();
        return view("transac.receipt", [
            "customers" => $customers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $services = DB::table('services')
            ->rightJoin('comments', 'comments.service_id', 'services.id')
            ->select('comments.id', 'comments.service_id', 'services.service_name', 'comments.name', 'comments.email', 'comments.comment')
            ->where('services.id', $id)
            ->get();

        return view('transac.show', ['services' => $services]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transactions = transac::find($id);
        $employees = employee::pluck("full_name", "id");
        $animals = pet::pluck("pet_name", "id");
        $services = Service::pluck("service_name", "id");
        return view("transac.edit", [
            "transactions" => $transactions,
            "employees" => $employees,
            "animals" => $animals,
            "services" => $services,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transactions = transac::find($id);
        $transactions->date = $request->input("date");
        $transactions->status = $request->input("status");
        $transactions->employee_id = $request->input("employee_id");
        $transactions->pets_id = $request->input("pets_id");
        $transactions->service_id = $request->input("service_id");
        $transactions->update();
        return Redirect::to("transac");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Delete($id)
    {
        $transactions = transac::findOrFail($id);
        $transactions->forceDelete();
        return Redirect::route("transac.index");
    }
}
