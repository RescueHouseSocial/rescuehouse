<template>
  <div id="DynamicLiveSession">
    <!-- <div id="videos">
      <div id="subscriber" ref="subscriberRef"></div>
      <div id="publisher" ref="publisherRef"></div>
    </div> -->
    <div id="video-chat-container">
      <section id="publisher-container">
        <div id="p" ref="publisherRef" class="h-48 w-48"></div>
      </section>
      <section id="subscribers-container">
        <div id="s" ref="subscriberRef" class="h-48 w-48"></div>
      </section>
    </div>
  </div>
</template>

<script>
  // import '@vonage/video-publisher/video-publisher.js';
  // import '@vonage/video-subscribers/video-subscribers.js';

  export default {
    name: "DynamicLiveSession",
    data() {
      return {};
    },
    created() {
      console.log("Created");
      // const apiKey = "56dcf05e";
      // const applicationId = "1d3cdf58-1880-455a-a5be-57f4d941b29f";
      // const sessionId = "2_MX4xZDNjZGY1OC0xODgwLTQ1NWEtYTViZS01N2Y0ZDk0MWIyOWZ-fjE3MTA1NDg5MjkxODd-RTBCVERqTnZMZHFjSkZmcGowWlJoNGZHfn5-";
      // const token = "eyJhbGciOiJSUzI1NiIsImprdSI6Imh0dHBzOi8vYW51YmlzLWNlcnRzLWMxLXVzZTEucHJvZC52MS52b25hZ2VuZXR3b3Jrcy5uZXQvandrcyIsImtpZCI6IkNOPVZvbmFnZSAxdmFwaWd3IEludGVybmFsIENBOjozMzM0MTEwMDIwNTM3ODE4MTgzNzYxMTYwNDkyMDc2MTE0MjI0OTAiLCJ0eXAiOiJKV1QiLCJ4NXUiOiJodHRwczovL2FudWJpcy1jZXJ0cy1jMS11c2UxLnByb2QudjEudm9uYWdlbmV0d29ya3MubmV0L3YxL2NlcnRzLzY1MjZhOWExOGUyN2YyZTVhOTkwMThiMjhjY2E5YTg0In0.eyJwcmluY2lwYWwiOnsiYWNsIjp7InBhdGhzIjp7Ii8qKiI6e319fSwidmlhbUlkIjp7ImVtYWlsIjoicmVzY3VlaG91c2Vzb2NpYWxAZ21haWwuY29tIiwiZ2l2ZW5fbmFtZSI6IkJlbmphbWluIiwiZmFtaWx5X25hbWUiOiJTY2hyb2VkZXIiLCJwaG9uZV9udW1iZXIiOiIxNTAzNzI5NzM5OSIsInBob25lX251bWJlcl9jb3VudHJ5IjoiVVMiLCJvcmdhbml6YXRpb25faWQiOiI5ODE0MTRhOS0yZmQ0LTRkMTgtYjM3Yi00OGUxZDljYTAwN2IiLCJhdXRoZW50aWNhdGlvbk1ldGhvZHMiOlt7ImNvbXBsZXRlZF9hdCI6IjIwMjQtMDMtMTVUMjM6MTk6MzUuMTkxNzQ3Mzk5WiIsIm1ldGhvZCI6ImludGVybmFsIn1dLCJhdWQiOiJwb3J0dW51cy5pZHAudm9uYWdlLmNvbSIsImV4cCI6MTcxMDU0OTIyOCwianRpIjoiYTBhMjAwZmEtMjBlMy00ZGQ4LTg3ZDctNmIwMDBhYTk4ODc2IiwiaWF0IjoxNzEwNTQ4OTI4LCJpc3MiOiJWSUFNLUlBUCIsIm5iZiI6MTcxMDU0ODkxMywic3ViIjoiNTZkYmVkYWEtYWVmYy00YzM2LWJkMDgtNjViYjUzNGMyNWVmIn19LCJmZWRlcmF0ZWRBc3NlcnRpb25zIjp7InZpZGVvLWFwaSI6W3siYXBpS2V5IjoiNTZkY2YwNWUiLCJhcHBsaWNhdGlvbklkIjoiMWQzY2RmNTgtMTg4MC00NTVhLWE1YmUtNTdmNGQ5NDFiMjlmIiwiZXh0cmFDb25maWciOnsidmlkZW8tYXBpIjp7ImluaXRpYWxfbGF5b3V0X2NsYXNzX2xpc3QiOiIiLCJyb2xlIjoibW9kZXJhdG9yIiwic2NvcGUiOiJzZXNzaW9uLmNvbm5lY3QiLCJzZXNzaW9uX2lkIjoiMl9NWDR4WkROalpHWTFPQzB4T0Rnd0xUUTFOV0V0WVRWaVpTMDFOMlkwWkRrME1XSXlPV1otZmpFM01UQTFORGc1TWpreE9EZC1SVEJDVkVScVRuWk1aSEZqU2tabWNHb3dXbEpvTkdaSGZuNS0ifX19XX0sImF1ZCI6InBvcnR1bnVzLmlkcC52b25hZ2UuY29tIiwiZXhwIjoxNzEwNTUwNzI5LCJqdGkiOiI3NjY4ZDliZC1lN2Q1LTRjODQtOGNhZi04NWFlZDg5YjRkM2EiLCJpYXQiOjE3MTA1NDg5MjksImlzcyI6IlZJQU0tSUFQIiwibmJmIjoxNzEwNTQ4OTE0LCJzdWIiOiI1NmRiZWRhYS1hZWZjLTRjMzYtYmQwOC02NWJiNTM0YzI1ZWYifQ.k0MkSbsoyhRpv7VsBnIbe4kj-2lSk3mq5brtcJqMTA0wlRCQL1i92XYmFnNlJHz8MLjIqGXFBU25OTuaU18duSGFmjr26Z7TknLsdY2rYkTQFnyuV3wU_R_w7MIkpeGaSNZ8UmKew98p00Jkatx4dAAv4uZhz11aan19aHRAUaDFiTI4W6ShcuAfRf_OLyDot13WqqT9IxCvZ0yl3OrAstvGHtDV9EGM16kiduNYx-t8wKZDzuIaKghaHDBwfz-ufZAjHoieEIZdGux5polOs6h8wSPAfptV2nVGSyrU8od0RbazMqxX5Z9_Tyr0CwVVSiY1W_nVSqmb_m9JLjRN1A";

      var appId = "8d54a346-9b95-4499-aff4-36942c3091d7"
      var sessionId = "2_MX44ZDU0YTM0Ni05Yjk1LTQ0OTktYWZmNC0zNjk0MmMzMDkxZDd-fjE3MTA1NDkwNjgzNjd-Tm5xb2ZLczR4bDFlTHVpbXc0c3VBeG1Xfn5-"
      var token = "eyJhbGciOiJSUzI1NiJ9.eyJhcHBsaWNhdGlvbl9pZCI6IjhkNTRhMzQ2LTliOTUtNDQ5OS1hZmY0LTM2OTQyYzMwOTFkNyIsImlhdCI6MTcxMDU0OTA2OCwianRpIjoiOGQ1NGEzNDYtOWI5NS00NDk5LWFmZjQtMzY5NDJjMzA5MWQ3Iiwic2NvcGUiOiJzZXNzaW9uLmNvbm5lY3QiLCJzZXNzaW9uX2lkIjoiMl9NWDQ0WkRVMFlUTTBOaTA1WWprMUxUUTBPVGt0WVdabU5DMHpOamswTW1Nek1Ea3haRGQtZmpFM01UQTFORGt3Tmpnek5qZC1UbTV4YjJaTGN6UjRiREZsVEhWcGJYYzBjM1ZCZUcxWGZuNS0iLCJyb2xlIjoicHVibGlzaGVyIiwiaW5pdGlhbF9sYXlvdXRfY2xhc3NfbGlzdCI6IiJ9.s6wQfUCECbhoEug_N7L2QEtEsfumuq_Ljv6M_1W4A6kEfK6Bp2Q-N-n4CPdPZ4qkoVNPlivXenHhAHHF5XRpTHywHLuPOzW8tbCeAXL5RafDYgB4s_0VAwrTySh5LKXBD2J_0I6uMdF8GZyGLpk8uzlOEHWv26_TG1UIngYsiuw5JFVxstZNFBHGYE0p30615PNl2Ct9hUNUE-ePlRKrvKjtWEZ97w6sLN4wY7M-3uL5B4GeUKMFF2MiL-o6HbhS5KfgY1wzpd7HPeUBjks1OskvJjZ_PMavYYZkETH1QqJFO0Q3aHojpuotc1k2ZO_ds5LEe46maYg6eguMgT_gDQ"


      var publisher = OT.initPublisher();
      const session = OT.initSession(appId, sessionId);
      
      
      session.on('streamCreated', (event) => {
        const subscriberOptions = {
          insertDefaultUI: false,
        };
        const subscriber = session.subscribe(event.stream, subscriberOptions, handleError);
        subscriber.on("videoElementCreated", function(event) {
          document.getElementById("s").appendChild(event.element);
        });
      });

      const publisherOptions = {
        insertDefaultUI: false,
      };
      publisher = OT.initPublisher(publisherOptions);
      publisher.on("videoElementCreated", function(event) {
        document.getElementById("p").appendChild(event.element);
      });

      session.connect(token, (error) => {
      // if (error) {
      //     this.showError(error);
      //   } else {
          session.publish(publisher);
        // }
      });



      // const subscriberElement = this.$refs.subscriberRef;
      // const publisherElement = this.$refs.publisherRef;

      // var session = OT.initSession(appId, sessionId);
      // // create publisher
      // var publisher = OT.initPublisher();
      // session.connect(token, function(err) {
      //   // publish publisher
      //   session.publish(publisher);
      // });

      // session.on('streamCreated', function (event) {
      //   session.subscribe(event.stream);
      // });

      // var session = OT.initSession(appId, sessionId);

      // var publisher = OT.initPublisher(publisherElement, {
      //   insertMode: 'append',
      //   width: '100%',
      //   height: '100%'
      // });

      // session.connect(token, function(error) {
      //   if (error) {
      //     console.log(error);
      //   } else {
      //     session.publish(publisher);
      //   }
      // });

      // session.on('streamCreated', function(event) {
      //   session.subscribe(event.stream, subscriberElement, {
      //     insertMode: 'append',
      //     width: '100%',
      //     height: '100%'
      //   });
      // });

    },
  };
</script>

<style>
#videos {
    position: relative;
    width: 100%;
    height: 100%;
    margin-left: auto;
    margin-right: auto;
}

#subscriber {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: 10;
}

#publisher {
    position: absolute;
    width: 360px;
    height: 240px;
    bottom: 10px;
    left: 10px;
    z-index: 100;
    border: 3px solid white;
    border-radius: 3px;
}
</style>