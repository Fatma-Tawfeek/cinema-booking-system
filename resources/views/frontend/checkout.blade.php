@extends('frontend.layouts.master')
@section('title', 'Checkout')

@section('content')
<div class="payment-container">
    
    <form id="payment-form" method="POST">
      @csrf
      <h1>Payment Form</h1>
      <label for="card-number">Card number</label>
      <div class="input-container card-number">
        <div class="icon-container">
          <img
            id="icon-card-number"
            src="{{ asset('frontend/img/card-icons/card.svg') }}"
            alt="PAN"
          />
        </div>
        <div class="card-number-frame"></div>
        <div class="icon-container payment-method">
          <img id="logo-payment-method" />
        </div>
        <div class="icon-container">
          <img id="icon-card-number-error" src="{{ asset('frontend/img/card-icons/error.svg')}}" />
        </div>
      </div>

      <div class="date-and-code">
        <div>
          <label for="expiry-date">Expiry date</label>
          <div class="input-container expiry-date">
            <div class="icon-container">
              <img
                id="icon-expiry-date"
                src="{{ asset('frontend/img/card-icons/exp-date.svg')}}"
                alt="Expiry date"
              />
            </div>
            <div class="expiry-date-frame"></div>
            <div class="icon-container">
              <img
                id="icon-expiry-date-error"
                src="{{ asset('frontend/img/card-icons/error.svg')}}"
              />
            </div>
          </div>
        </div>

        <div>
          <label for="cvv">Security code</label>
          <div class="input-container cvv">
            <div class="icon-container">
              <img id="icon-cvv" src="{{ asset('frontend/img/card-icons/cvv.svg')}}" alt="CVV" />
            </div>
            <div class="cvv-frame"></div>
            <div class="icon-container">
              <img id="icon-cvv-error" src="{{ asset('frontend/img/card-icons/error.svg')}}" />
            </div>
          </div>
        </div>
      </div>

      <button id="pay-button" disabled="">
        PAY {{ $booking->grand_total }} USD
      </button>

      <div>
        <span class="error-message error-message__card-number"></span>
        <span class="error-message error-message__expiry-date"></span>
        <span class="error-message error-message__cvv"></span>
      </div>

    </form>
    <p class="success-payment-message"></p>

</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('frontend/payment.css') }}" />
<style>
    #payment-form {
    opacity: 1;
    transition: opacity 0.5s;
}

.success-payment-message {
    opacity: 0;
    transform: translateY(-20px);
    transition: opacity 0.5s, transform 0.5s;
    position: absolute;
    top: 50%;
    z-index: 999;
    font-size: 30px;
    font-weight: 500;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.checkout.com/js/framesv2.min.js"></script>

{{-- <script src="{{ asset('frontend/payment.js') }}"></script> --}}

<script>

    /* global Frames */
var payButton = document.getElementById("pay-button");
var form = document.getElementById("payment-form");

Frames.init({
    publicKey: "pk_sbox_tejoufxe2lpmrbevlziq7rcssek",
    debug: true,
    style: {
        base: {
            fontSize: "16px",
            color: "white",
        },
    },
});

var logos = generateLogos();
function generateLogos() {
    var logos = {};
    logos["card-number"] = {
        src: "card",
        alt: "card number logo",
    };
    logos["expiry-date"] = {
        src: "exp-date",
        alt: "expiry date logo",
    };
    logos["cvv"] = {
        src: "cvv",
        alt: "cvv logo",
    };
    return logos;
}

var errors = {};
errors["card-number"] = "Please enter a valid card number";
errors["expiry-date"] = "Please enter a valid expiry date";
errors["cvv"] = "Please enter a valid cvv code";

Frames.addEventHandler(
    Frames.Events.FRAME_VALIDATION_CHANGED,
    onValidationChanged
);
function onValidationChanged(event) {
    var e = event.element;

    if (event.isValid || event.isEmpty) {
        if (e === "card-number" && !event.isEmpty) {
            showPaymentMethodIcon();
        }
        setDefaultIcon(e);
        clearErrorIcon(e);
        clearErrorMessage(e);
    } else {
        if (e === "card-number") {
            clearPaymentMethodIcon();
        }
        setDefaultErrorIcon(e);
        setErrorIcon(e);
        setErrorMessage(e);
    }
}

function clearErrorMessage(el) {
    var selector = ".error-message__" + el;
    var message = document.querySelector(selector);
    message.textContent = "";
}

function clearErrorIcon(el) {
    var logo = document.getElementById("icon-" + el + "-error");
    logo.style.removeProperty("display");
}

function showPaymentMethodIcon(parent, pm) {
    if (parent) parent.classList.add("show");

    var logo = document.getElementById("logo-payment-method");
    if (pm) {
        var name = pm.toLowerCase();
        logo.setAttribute(
            "src",
            "{{ asset('frontend/img/card-icons/" + name + ".svg' ) }}"
        );
        logo.setAttribute("alt", pm || "payment method");
    }
    logo.style.removeProperty("display");
}

function clearPaymentMethodIcon(parent) {
    if (parent) parent.classList.remove("show");

    var logo = document.getElementById("logo-payment-method");
    logo.style.setProperty("display", "none");
}

function setErrorMessage(el) {
    var selector = ".error-message__" + el;
    var message = document.querySelector(selector);
    message.textContent = errors[el];
}

function setDefaultIcon(el) {
    var selector = "icon-" + el;
    var logo = document.getElementById(selector);
    logo.setAttribute(
        "src",
        "{{ asset('frontend/img/card-icons/" + logos[el].src + ".svg')}}"
    );
    logo.setAttribute("alt", logos[el].alt);
}

function setDefaultErrorIcon(el) {
    var selector = "icon-" + el;
    var logo = document.getElementById(selector);
    logo.setAttribute(
        "src",
        "{{ asset('frontend/img/card-icons/" + logos[el].src + "-error.svg') }}"
    );
    logo.setAttribute("alt", logos[el].alt);
}

function setErrorIcon(el) {
    var logo = document.getElementById("icon-" + el + "-error");
    logo.style.setProperty("display", "block");
}

Frames.addEventHandler(
    Frames.Events.CARD_VALIDATION_CHANGED,
    cardValidationChanged
);
function cardValidationChanged() {
    payButton.disabled = !Frames.isCardValid();
}

Frames.addEventHandler(
    Frames.Events.CARD_TOKENIZATION_FAILED,
    onCardTokenizationFailed
);
function onCardTokenizationFailed(error) {
    console.log("CARD_TOKENIZATION_FAILED: %o", error);
    Frames.enableSubmitForm();
}

Frames.addEventHandler(Frames.Events.CARD_TOKENIZED, onCardTokenized);
function onCardTokenized(event) {
    var el = document.querySelector(".success-payment-message");

    // processPayment [POST] -> {(invoiceId/orderId .. .etc), cardToken}
    postData("{{ route('bookings.paymentProcess') }}", {
        bookingId: {{ $booking->id }},
        cardToken: event.token,
    }).then((data) => {
        console.log(data);
        if (data.approved) {
         // Hide the payment form with smooth animation
        form.style.transition = "opacity 0.5s";
        form.style.opacity = 0;

        // Show the success message with smooth animation
        el.innerHTML = `<p style="color:green">Your Payment is Successful</p>`;
        el.style.transition = "opacity 0.5s, transform 0.5s";
        el.style.opacity = 1;
        el.style.transform = "translateY(0)";


        // Optionally, you can add a delay to redirect the user to another page
        setTimeout(function() {
            window.location.href = "{{ route('home') }}"; // Redirect to home page
        }, 3000); // Redirect after 3 seconds (adjust as needed)
        } else {
            el.innerHTML = `<p style="color:red">Payment Failed</p>`;
        }
    });
}

Frames.addEventHandler(
    Frames.Events.PAYMENT_METHOD_CHANGED,
    paymentMethodChanged
);
function paymentMethodChanged(event) {
    var pm = event.paymentMethod;
    let container = document.querySelector(".icon-container.payment-method");

    if (!pm) {
        clearPaymentMethodIcon(container);
    } else {
        clearErrorIcon("card-number");
        showPaymentMethodIcon(container, pm);
    }
}

form.addEventListener("submit", onSubmit);
function onSubmit(event) {
    event.preventDefault();
    Frames.submitCard();
}

// Example POST method implementation:
async function postData(url = "", data = {}) {
    // Default options are marked with *
    const response = await fetch(url, {
        method: "POST", // *GET, POST, PUT, DELETE, etc.
        mode: "cors", // no-cors, *cors, same-origin
        cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
        credentials: "same-origin", // include, *same-origin, omit
        headers: {
            "Content-Type": "application/json",
            // 'Content-Type': 'application/x-www-form-urlencoded',
        },
        redirect: "follow", // manual, *follow, error
        referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
        body: JSON.stringify(data), // body data type must match "Content-Type" header
    });
    return response.json(); // parses JSON response into native JavaScript objects
}

</script>
@endpush

