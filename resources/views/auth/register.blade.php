
@include('sections.head')
<style>
    .__login {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        display: grid;
        align-items: center;
        justify-content: center;
        background: url(../img/gradient.png);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-color: var(--text);
    }
    .__login-area {
        width: 500px;
        height: 720px;
        padding-bottom: 50px;
        box-shadow: 0 0 1rem 0 rgba(0, 0, 0, .2); 
        border-radius: 5px;
        position: relative;
        z-index: 1;
        background: inherit;
        overflow: hidden;
        display: grid;
        align-items: center;
        justify-items: center;
        font-family: sans-serif;
    }
    .__login-area:before {
        content: "";
        position: absolute;
        background: inherit;
        z-index: -1;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        box-shadow: inset 0 0 2000px rgb(197 56 56 / 20%);
        filter: blur(10px);
        margin: 5px;
    }
    .__login-area form {
        width: 60%;
    }
    .__form {
        display: grid;
        color: var(--color);
        margin-bottom: 50px;
    }
    .__form label {
        font-family: sans-serif;
        margin-bottom: 10px;
    }
    .__form input {
        padding: 5px;
        border: unset;
        background: unset;
        border-bottom: 1px solid var(--color);
        color: var(--color);
    }
    .__form input:focus-visible {
        outline: 0;
    }
    .__form input:focus {
        --tw-ring-shadow: unset;
    }
    .__login-area button {
        margin-bottom: 25px;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 40px;
        background: unset;
        border: 1px solid var(--color);
        font-size: 16px;
        color: var(--color);
        cursor: pointer;
    }
    .__login-area button:hover {
        background: #000;
        color: var(--color);
        border: 1px solid var(--color);
    }
    .__remember {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 25px;
    }
    .__remember input {
        margin: 0;
    }
    .__remember span {
        color: var(--color);
        margin: 0 0 0 10px;
        padding: 0;
    }
    .__forgot {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }
    .__forgot a {
        color: var(--color);
        text-decoration: none;
    }
    .__forgot a:hover {
        color: aqua;
    }
    .__logo {
        top: unset;
        left: unset;
    }
</style>
<div class="__login">
    <div class="__login-area">
        <div class="__logo">
            <span>p</span>
            <span>ardiyo</span>
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Email Address -->
            <div class="__form">
                <label for="name">Name</label>
                <input type="text" name="name" required autofocus>
            </div>

            <!-- Email Address -->
            <div class="__form">
                <label for="email">E-Mail</label>
                <input type="text" name="email" required autofocus>
            </div>
    
            <!-- Password -->
            <div class="__form">
                <label for="password">Password</label>
                <input type="password" name="password" required autocomplete="current-password">
            </div>

            <div class="__form">
                <label for="password_confirmation">Password</label>
                <input type="password" name="password_confirmation" required autocomplete="current-password">
            </div>

            <button type="submit">
                {{ __('Register') }}
            </button>
        </form>
    </div>
</div>