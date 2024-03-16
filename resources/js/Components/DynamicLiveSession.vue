<template>
  <div id="DynamicLiveSession">
    <section id="publisher-container">
      <fieldset>
        <legend>Publisher</legend>
        <video-publisher ref="publisher"></video-publisher>
      </fieldset>
      <button id="video-toggle">toggle Video</button>
      <button id="audio-toggle">toggle Audio</button>
    </section>
    <section id="subscribers-container">
      <fieldset>
        <legend>Subscribers</legend>
        <video-subscribers ref="subscribers"></video-subscribers>
      </fieldset>
    </section>
  </div>
</template>

<script>
  import '@vonage/video-publisher/video-publisher.js';
  import '@vonage/video-subscribers/video-subscribers.js';

  export default {
    name: "DynamicLiveSession",
    data() {
      return {
        session: null,
      };
    },
    created() {
      console.log("Created");
      const applicationId = "1d3cdf58-1880-455a-a5be-57f4d941b29f";
      const sessionId = "2_MX4xZDNjZGY1OC0xODgwLTQ1NWEtYTViZS01N2Y0ZDk0MWIyOWZ-fjE3MTA1NDU3ODE0ODh-bTRwcWVUVHFPaHlGb2RFLzR0V291MUh2fn5-";
      const token = "eyJhbGciOiJSUzI1NiIsImprdSI6Imh0dHBzOi8vYW51YmlzLWNlcnRzLWMxLXVzZTEucHJvZC52MS52b25hZ2VuZXR3b3Jrcy5uZXQvandrcyIsImtpZCI6IkNOPVZvbmFnZSAxdmFwaWd3IEludGVybmFsIENBOjozMzM0MTEwMDIwNTM3ODE4MTgzNzYxMTYwNDkyMDc2MTE0MjI0OTAiLCJ0eXAiOiJKV1QiLCJ4NXUiOiJodHRwczovL2FudWJpcy1jZXJ0cy1jMS11c2UxLnByb2QudjEudm9uYWdlbmV0d29ya3MubmV0L3YxL2NlcnRzLzY1MjZhOWExOGUyN2YyZTVhOTkwMThiMjhjY2E5YTg0In0.eyJwcmluY2lwYWwiOnsiYWNsIjp7InBhdGhzIjp7Ii8qKiI6e319fSwidmlhbUlkIjp7ImVtYWlsIjoicmVzY3VlaG91c2Vzb2NpYWxAZ21haWwuY29tIiwiZ2l2ZW5fbmFtZSI6IkJlbmphbWluIiwiZmFtaWx5X25hbWUiOiJTY2hyb2VkZXIiLCJwaG9uZV9udW1iZXIiOiIxNTAzNzI5NzM5OSIsInBob25lX251bWJlcl9jb3VudHJ5IjoiVVMiLCJvcmdhbml6YXRpb25faWQiOiI5ODE0MTRhOS0yZmQ0LTRkMTgtYjM3Yi00OGUxZDljYTAwN2IiLCJhdXRoZW50aWNhdGlvbk1ldGhvZHMiOlt7ImNvbXBsZXRlZF9hdCI6IjIwMjQtMDMtMTVUMjM6MTk6MzUuMTkxNzQ3Mzk5WiIsIm1ldGhvZCI6ImludGVybmFsIn1dLCJhdWQiOiJwb3J0dW51cy5pZHAudm9uYWdlLmNvbSIsImV4cCI6MTcxMDU0NjA4MSwianRpIjoiYjU0MjYwNGUtMmI0Zi00ZjA1LWE4YjItZjE4OTA2NDNjNTAwIiwiaWF0IjoxNzEwNTQ1NzgxLCJpc3MiOiJWSUFNLUlBUCIsIm5iZiI6MTcxMDU0NTc2Niwic3ViIjoiNTZkYmVkYWEtYWVmYy00YzM2LWJkMDgtNjViYjUzNGMyNWVmIn19LCJmZWRlcmF0ZWRBc3NlcnRpb25zIjp7InZpZGVvLWFwaSI6W3siYXBpS2V5IjoiNTZkY2YwNWUiLCJhcHBsaWNhdGlvbklkIjoiMWQzY2RmNTgtMTg4MC00NTVhLWE1YmUtNTdmNGQ5NDFiMjlmIiwiZXh0cmFDb25maWciOnsidmlkZW8tYXBpIjp7ImluaXRpYWxfbGF5b3V0X2NsYXNzX2xpc3QiOiIiLCJyb2xlIjoibW9kZXJhdG9yIiwic2NvcGUiOiJzZXNzaW9uLmNvbm5lY3QiLCJzZXNzaW9uX2lkIjoiMl9NWDR4WkROalpHWTFPQzB4T0Rnd0xUUTFOV0V0WVRWaVpTMDFOMlkwWkRrME1XSXlPV1otZmpFM01UQTFORFUzT0RFME9EaC1iVFJ3Y1dWVVZIRlBhSGxHYjJSRkx6UjBWMjkxTVVoMmZuNS0ifX19XX0sImF1ZCI6InBvcnR1bnVzLmlkcC52b25hZ2UuY29tIiwiZXhwIjoxNzEzMTM3NzgxLCJqdGkiOiIwYmIzMmUzZC0yZjczLTQ2OWQtYjU0Ny1kNDcxM2MwOGE1NjkiLCJpYXQiOjE3MTA1NDU3ODEsImlzcyI6IlZJQU0tSUFQIiwibmJmIjoxNzEwNTQ1NzY2LCJzdWIiOiI1NmRiZWRhYS1hZWZjLTRjMzYtYmQwOC02NWJiNTM0YzI1ZWYifQ.CrUVflnhtXAsDLhDx--2U9NZeFp8PfoXNIoyjjoaxG0OUcMnfvAaQHrpmoJ7oNdsoUqREv2zBfu32bx82-SDV8r-VDJzdUruX1riy1REoUm8xy511QOLQbWBs1JKKy4z6ddmYGW44qTFWgqrgth7h-uff-dCMCZ9wHN1EkQZblyLYYlOkscPjGmqA0QIDE3hh8jTwNAlFOQOrJ42HBzkFCMI6VUei0OlW-d0T1WtSVOEiZvUa_4pKKRpoQh6g3o54oY59NGu-A1mH2pCDPH9q2fFRr2UYbb8YNMKxp7pcgIHXmLl9GBCQZ3MJnetukWogm_6WcJ7-CBbfFdq5wZNMA";
      const session = OT.initSession(applicationId, sessionId);
      this.$refs.publisher.session = session;
      this.$refs.publisher.token = token;
      this.$refs.publisher.properties = {
        fitMode: "cover",
        width: "100%",
        height: "100%",
        resolution: "1920x1080",
        frameRate: 30,
        videoContentHint: "detail",
      };
      this.$refs.subscribers.session = session;
      this.$refs.subscribers.token = token;
    },
  };
</script>