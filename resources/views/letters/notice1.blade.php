<div class="container" style="font-size:14px;font-family:Times;">
    <div align="center">
        <img src="{{ base_path() }}/public/img/fit-body-logo-transparency.png" style="max-width:33%;"><br>
        FitBody Easthampton<br>
        396 Main Street<br>
        Easthampton, MA 01027<br>
        (413) 517-3898
    </div>

    <p>{{ $date }}</p>

    <h3>Your valuable fitness plan needs your attention!</h3>

    <p>Dear {{ $customer->first_name }} {{ $customer->last_name }},</p>

    <p>We weren't able to debit your account recently and there is a balance due on your account.</p>

    <h4>Current Balance Due: ${{ abs($customer->account_balance) }}</h4>

    <p>To avoid any disruption of service or additional fees, it is important that you log into the FitBody Site to
        verify your billing information and resubmit the charge. Alernatively, you may call us or come to FitBody to
        update your information in person.</p>

    <h4>How to Update Your Information Online</h4>

    <p>You can update your billing information in a matter of seconds. Here's all you need to do:</p>
    <ol>
        <li>Go to http://clients.mindbodyonline.com/ws.asp?studioid=27796
        <li>Log in. (Your user name is {{ $customer->email }})
        <li>Follow the instructions on the screen.
    </ol>
    <h4>Comments and Questions</h4>

    <p>If you have any additional questions, then please feel free to contact us using the email or phone number listed
        below.</p>

    <p>Thank you for being our client. We value your business!</p>

    <p>The FitBody Team
        <br>Web: https://getmyfitbody.com
        <br>Email: info@getmyfitbody.com
        <br>Phone: (413) 517-3898</p>

</div>

