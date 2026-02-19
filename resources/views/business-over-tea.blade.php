@extends('default')

@section('content')
<div class="home-page-layout" >
    <header class="hero">
        <div class="container">
            <div class="hero-banner">
                <div class="card">
                  <div class="left">
                      <div class="img-group">
                        <img class="img1" src="{{ asset('includes/business-over-tea/images/banner/img1.png') }}" />
                        <img class="img2" src="{{ asset('includes/business-over-tea/images/banner/img2.png') }}" />
                      </div>
                  </div>

                  <div class="right">
                      

                      <h1>Business Over Tea</h1>

                      <h3>A private circle for founders, business owners & decision-makers.</h3>

                      <p class="one">Real conversations. </p>
                      <p class="two">Trusted founders.</p>
                      <p class="three">Over a cup of tea.</p>
                    
                  </div>                    
                </div>
            </div>

            <div class="heroGrid">
                <div class="card heroLeft">
                <div class="heroInner">
                    

                    <!-- Updated copy: founders-led but not founders-exclusive -->
                    <p class="lead">Business Over Tea is a private, invite-only circle created for founders, business owners & decision-makers who believe the best insights don’t come from stages — they come from honest conversations.</p>

                    <div class="pillRow" aria-label="Key attributes">
                      <span class="pill">Invite-only</span>
                      <span class="pill">No pitching</span>
                      <span class="pill">Small curated groups</span>
                      <span class="pill">Confidential by design</span>
                    </div>

                    <div class="ctaRow">
                    <a class="btn" href="#request">Submit a request for invitation →</a>
                    <a class="btn secondary" href="#how">See how it works</a>
                    </div>

                    <div class="micro">
                    Some call it <b>“Chai par Business”</b>. The spirit stays the same: depth, trust, founder-first dialogue.
                    </div>
                </div>
                </div>

                <aside class="card heroRight" aria-label="Summary card">
                  <div class="heroInner">
                    <p class="h2mini">Not a networking event.</p>
                    <p class="rightText">
                      This is a <b>conversation among equals</b> — built for people who value depth over noise.
                    </p>

                    <div class="quote">
                      “No stage. No microphones. No selling. Just founders talking real business.”
                    </div>

                    <div class="gridStats" aria-label="What to expect">
                      <div class="stat">
                        <strong>Curated</strong>
                        <span>Quality over quantity</span>
                      </div>
                      <div class="stat">
                        <strong>Private</strong>
                        <span>Confidential discussions</span>
                      </div>
                      <div class="stat">
                        <strong>Practical</strong>
                        <span>Experience, not theory</span>
                      </div>
                      <div class="stat">
                        <strong>Respectful</strong>
                        <span>Listen-first culture</span>
                      </div>
                    </div>
                  </div>
                </aside>

            </div>
        </div>
    </header>

    <!-- About -->
    <section id="about">
      <div class="container">
        <div class="sectionCard">
          <h2>What is Business Over Tea?</h2>
          <p>
            In today’s fast-moving world, founders rarely get a safe space to talk openly. Business Over Tea is designed to change that.
          </p>
          <p>
            It’s a closed-door circle where selected business owners meet in a relaxed environment to share real experiences,
            discuss challenges without judgment, and build meaningful long-term connections.
          </p>

          <div class="callout">
            <div class="ic">☕</div>
            <div>
              <div style="font-weight:800; color:var(--text); margin-bottom:4px;">Why “Over Tea”?</div>
              Tea slows things down. Over tea, conversations become honest, listening matters more, and trust builds naturally.
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- For who -->
    <section id="forwho">
      <div class="container">
        <div class="twoCol">
          <div class="sectionCard">
            <h2>Who is this for?</h2>
            <p>Business Over Tea is curated for:</p>
            <ul>
              <li>Founders & co-founders</li>
              <li>Business owners & partners</li>
              <li>CEOs & managing directors</li>
              <li>Decision-makers running active businesses</li>
            </ul>
          </div>

          <div class="sectionCard">
            <h2>Not suitable for</h2>
            <p>This circle is not for:</p>
            <ul>
              <li>Sales pitching or aggressive networking</li>
              <li>MLM promotions</li>
              <li>Job hunting</li>
              <li>One-time “introductions only” meetups</li>
            </ul>
            <div class="callout">
              <div class="ic">✓</div>
              <div>
                <div style="font-weight:800; color:var(--text); margin-bottom:4px;">Depth over numbers</div>
                We keep gatherings small so every founder is heard.
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- How -->
    <section id="how">
      <div class="container">
        <div class="sectionCard">
          <h2>How the circle works</h2>
          <p>Simple rules, strong culture.</p>

          <div class="steps">
            <div class="step">
              <b>1️⃣ Invitation-only</b>
              <small>Participation is by invitation/approval to keep the quality high.</small>
            </div>
            <div class="step">
              <b>2️⃣ Curated groups</b>
              <small>Small gatherings designed for real conversation, not crowd management.</small>
            </div>
            <div class="step">
              <b>3️⃣ No stage</b>
              <small>No speakers, no panels — founders sit together as equals.</small>
            </div>
            <div class="step">
              <b>4️⃣ Confidential</b>
              <small>What’s shared in the room stays in the room.</small>
            </div>
          </div>

          <div class="divider"></div>

          <div class="twoCol">
            <div>
              <h2 style="margin-top:0;">What happens in a session?</h2>
              <ul>
                <li>Member introductions (brief & meaningful)</li>
                <li>Open discussion on real challenges</li>
                <li>Experience sharing (not advice preaching)</li>
                <li>Quiet listening and thoughtful exchange</li>
              </ul>
            </div>
            <div>
              <h2 style="margin-top:0;">Common topics</h2>
              <ul>
                <li>Growth pains and scale</li>
                <li>Market slowdowns & opportunities</li>
                <li>Hiring & leadership challenges</li>
                <li>Cash flow and sustainability</li>
                <li>The personal journey of leadership</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Host -->
    <section>
      <div class="container">
        <div class="twoCol">
          <div class="sectionCard">
            <h2>Where do meetings happen?</h2>
            <p>
              We start in Riyadh with small, quiet, curated venues. Locations are shared only with invited members.
            </p>
            <ul>
              <li>📍 Riyadh (initially)</li>
              <li>📍 Private venues</li>
              <li>📍 Details shared only to invited founders</li>
            </ul>
          </div>

          <div class="sectionCard">
            <h2>About the host</h2>
            <p>
              Business Over Tea is an initiative by <b>Nuvanta Group</b>, created to support meaningful business ecosystems beyond transactions.
            </p>
            <ul>
              <li>Long-term value</li>
              <li>Ethical growth</li>
              <li>Quiet leadership</li>
              <li>Founder-first thinking</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- Request -->
    <section id="request">
      <div class="container">
        <div class="sectionCard">
          <h2>Request an invitation</h2>
          <p>
            Business Over Tea is not open registration. If you feel aligned with this circle, submit a request below.
            Your request will be reviewed. If aligned, you’ll receive a personal invitation with private details.
          </p>

          <div class="filterBox">
            <h3>This circle may not be suitable if you are:</h3>
            <ul>
              <li>Looking for jobs, clients, or quick networking</li>
              <li>Promoting services, offers, or MLM-style programs</li>
              <li>Interested only in introductions, not founder-level dialogue</li>
            </ul>
          </div>

          <form id="inviteForm" action="{{ route('contact.store') }}" method="POST" novalidate>
            @csrf
            <input type="hidden" name="form_type" value="business_over_tea_invitation" />
            <div>
              <label for="name">Full name <span class="required">*</span></label>
              <input id="name" name="name" type="text" placeholder="Your name" autocomplete="name" required />
              <span class="text-danger error-msg" data-error="name"></span>
            </div>

            <div>
              <label for="email">Email <span class="required">*</span></label>
              <input id="email" name="email" type="email" placeholder="you@example.com" autocomplete="email" required />
              <span class="text-danger error-msg" data-error="email"></span>
            </div>

            <div>
              <label for="phone">Mobile <span class="required">*</span></label>
              <input id="phone" name="phone" type="tel" placeholder="+966..." autocomplete="tel" />
              <span class="text-danger error-msg" data-error="phone"></span>
            </div>

            <div>
              <label for="location">Current city <span class="required">*</span></label>
              <input id="location" name="location" type="text" placeholder="Riyadh / Jeddah / Dammam..." autocomplete="address-level2" required />
              <span class="text-danger error-msg" data-error="location"></span>
            </div>

            <div>
              <label for="company">Company / business name <span class="required">*</span></label>
              <input id="company" name="company" type="text" placeholder="Your company name" autocomplete="organization" required />
              <span class="text-danger error-msg" data-error="company"></span>
            </div>

            <div>
              <label for="no_of_employee">Number of employees <span class="required">*</span></label>
              <select id="no_of_employee" name="no_of_employee" required>
                <option value="" disabled selected>Select</option>
                <option>1 - 10</option>
                <option>11 - 50</option>
                <option>51- 100</option>
                <option>101 - 250</option>
                <option>More than 250</option>
              </select>
              <span class="text-danger error-msg" data-error="no_of_employee"></span>
            </div>

            <div>
              <label for="role">Your role <span class="required">*</span></label>
              <select id="role" name="role" required>
                <option value="" disabled selected>Select</option>
                <option>Founder / Co-founder</option>
                <option>Owner / Partner</option>
                <option>CEO / Managing Director</option>
                <option>Other (active decision maker)</option>
              </select>
              <span class="text-danger error-msg" data-error="role"></span>
            </div>

            <div>
              <label for="industry">Industry <span class="required">*</span></label>
              <input id="industry" name="industry" type="text" placeholder="Printing / Trading / Tech / Real estate..." required />
              <span class="text-danger error-msg" data-error="industry"></span>
            </div>

            <div class="full">
              <label for="note">Why do you want to join?</label>
              <textarea id="note" name="note" placeholder="In 3–5 lines, tell us what you value and what kind of conversations you want."></textarea>
              <span class="text-danger error-msg" data-error="note"></span>
            </div>

            <div class="full formFooter">
              <button class="btn" type="submit">Submit a request for invitation →</button>
            </div>
          </form>

          <div id="formResult" class="result" role="status" aria-live="polite"></div>

          <div class="divider"></div>

          <p style="margin:0; color:var(--muted);">
            Some conversations don’t need a stage. Some connections don’t need noise. They just need time, trust, and tea.
            <br /><b style="color:var(--text)">Business Over Tea</b> — a private circle for founders, business owners & decision-makers.
          </p>
        </div>
      </div>
    </section>
</div>

@endsection

@section('scriptFile')
<script>
   $(document).ready(function () {
      $('#inviteForm').on('submit', function (e) {
         e.preventDefault();

         let form = $(this);
         let submitButton = form.find('button[type="submit"]');
         let originalText = submitButton.html(); // store original button text
         let formData = form.serialize();

         // 🔄 Show loader on button
         submitButton.prop('disabled', true).html('<span class="button__text"><i class="fa fa-spinner fa-spin"></i> Submitting...</span>');

         $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: formData,
            success: function (response) {
               $('#formResult').show().html(
                  `<div class="alert alert-success">Thank you for your interest! We will reach out with updates and invitations.</div>`
               );

               $('.error-msg').text('');

               form[0].reset();               

               // hide message after 3s
               setTimeout(function () {
                  $('#formResult').fadeOut('slow', function () {
                     $(this).html('').hide();
                  });
               }, 3000);
            },
            error: function (xhr) {
               // Clear previous errors
               $('.error-msg').text('');

               let errors = xhr.responseJSON?.errors;

               if (errors) {
                  $.each(errors, function (key, value) {
                     $(`span[data-error="${key}"]`).text(value[0]);
                  });
               } else {
                  $('#formResult').html(
                     '<div class="alert alert-danger">Something went wrong. Try again.</div>'
                  );
               }
            },
            complete: function () {
               // ✅ Restore button after success or failure
               submitButton.prop('disabled', false).html(originalText);
            }
         });
      });
   });
</script>
@endsection