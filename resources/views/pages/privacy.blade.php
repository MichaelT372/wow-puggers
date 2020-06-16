@extends('layouts.app')

@section('content')
  <div class="container my-4">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <h1 class="text-primary">Privacy Policy</h1>
        <p>
          This privacy policy will explain how our WoW Puggers uses the personal data we collect from you when you
          use our website.
        </p>

        <h5 class="text-primary">Topics:</h5>
        <ul>
          <li>What data do we collect?</li>
          <li>How do we collect your data?</li>
          <li>How will we use your data?</li>
          <li>How do we store your data?</li>
          <li>Marketing</li>
          <li>What are your data protection rights?</li>
          <li>What are cookies?</li>
          <li>How do we use cookies?</li>
          <li>What types of cookies do we use?</li>
          <li>How to manage your cookies</li>
          <li>Privacy policies of other websites</li>
          <li>Changes to our privacy policy</li>
          <li>How to contact us</li>
          <li>How to contact the appropriate authorities</li>
        </ul>

        <h5 class="text-primary">WoW Puggers collects the following data:</h5>
        <p>Name or character name, email address and information about your World of Warcraft character.</p>

        <h5 class="text-primary">How do we collect your data?</h5>
        <p>You directly provide WoW Puggers with the data we collect. We collect data and process data when you:</p>

        <ul>
          <li>Register to the website</li>
          <li>Sign up for a raid</li>
        </ul>

        <h5 class="text-primary">How will we use your data?</h5>
        <p>WoW Puggers collects your data so that:</p>

        <ul>
          <li>You can use the website i.e. create raids, sign up for raids</li>
          <li>You can reset your password for your account if you forget it</li>
        </ul>

        <p>WoW Puggers will not share your data.</p>

        <h5 class="text-primary">How do we store your data?</h5>
        <p>WoW Puggers stores your data in a database on a secure cloud server which is hosted in London, United Kingdom. WoW Puggers will keep your account data indefinitely. You can <a href="{{ route('contact') }}">contact us</a> to request your account is deleted.</p>

        <h5 class="text-primary">Marketing</h5>
        <p>WoW Puggers would like to send you information about products and services of ours that we think you might like.</p>
        <p>If you have agreed to receive marketing, you may always opt out at a later date.</p>
        <p>You have the right at any time to stop WoW Puggers from contacting you for marketing purposes.</p>
        <p>If you no longer wish to be contacted for marketing purposes, please <a href="{{ route('contact') }}">contact us</a>.</p>

        <h5 class="text-primary">What are your data protection rights?</h5>
        <p>WoW Puggers would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</p>

        <p>The right to access – You have the right to request WoW Puggers for copies of your personal data. We may charge you a small fee for this service.</p>

        <p>The right to rectification – You have the right to request that WoW Puggers correct any information you believe is inaccurate. You also have the right to request WoW Puggers to complete the information you believe is incomplete.</p>

        <p>The right to erasure – You have the right to request that WoW Puggers erase your personal data, under certain conditions.</p>

        <p>The right to restrict processing – You have the right to request that WoW Puggers restrict the processing of your personal data, under certain conditions.</p>

        <p>The right to object to processing – You have the right to object to WoW Puggers’s processing of your personal data, under certain conditions.</p>

        <p>The right to data portability – You have the right to request that WoW Puggers transfer the data that we have collected to another organization, or directly to you, under certain conditions.</p>

        <p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please <a href="{{ route('contact') }}">contact us</a>.</p>

        <h5 class="text-primary">Cookies</h5>
        <p>Cookies are text files placed on your computer to collect standard Internet log information and visitor behavior information. When you visit our websites, we may collect information from you automatically through cookies or similar technology</p>
        <p>For further information, visit <a href="https://allaboutcookies.org">allaboutcookies.org.</a></p>

        <h5 class="text-primary">How do we use cookies?</h5>
        <p>WoW Puggers uses cookies in a range of ways to improve your experience on our website, including:</p>

        <ul>
          <li>Keeping you signed in</li>
          <li>Understanding how you use our website</li>
        </ul>

        <h5 class="text-primary">What types of cookies do we use?</h5>
        <p>There are a number of different types of cookies, however, our website uses:</p>

        <ul>
          <li>Functionality – WoW Puggers uses these cookies so that we recognize you on our website and remember your previously selected preferences. These could include what language you prefer and location you are in. First-party cookies are used.</li>
          <li>Analytics – WoW Puggers uses these cookies to collect information about your visit to our website, the content you viewed, the links you followed and information about your browser, device, and an anonymized form of your IP address. This helps us to improve the website and is done using Google Analytics in a way that does not directly identify you.</li>
        </ul>

        <h5 class="text-primary">How to manage cookies</h5>
        <p>You can set your browser not to accept cookies, and the above website tells you how to remove cookies from your browser. However, in a few cases, some of our website features may not function as a result.</p>

        <h5 class="text-primary">Privacy policies of other websites</h5>
        <p>The WoW Puggers website contains links to other websites. Our privacy policy applies only to our website, so if you click on a link to another website, you should read their privacy policy.</p>

        <h5 class="text-primary">Changes to our privacy policy</h5>
        <p>WoW Puggers keeps its privacy policy under regular review and places any updates on this web page. This privacy policy was last updated on 16th June 2020.</p>

        <h5 class="text-primary">How to contact us</h5>
        <p>If you have any questions about WoW Puggers’s privacy policy, the data we hold on you, or you would like to exercise one of your data protection rights, please do not hesitate to <a href="{{ route('contact') }}">contact us</a>.</p>

        <h5 class="text-primary">How to contact the appropriate authority</h5>
        Should you wish to report a complaint or if you feel that WoW Puggers has not addressed your concern in a satisfactory manner, you may <a href="https://ico.org.uk/">contact the Information Commissioner’s Office</a>.
      </div>
    </div>
@endsection
