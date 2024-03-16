<template>
  <div id="DynamicLiveSession">
    <div id="videos">
      <div id="subscriber"></div>
      <div id="publisher"></div>
    </div>
  </div>
</template>

<script>

  export default {
    name: "DynamicLiveSession",
    props: ["opentok_api_key", "sessionId", "token"],
    data() {
      return {};
    },
    async mounted() {
      this.initializeSession();
    },
    methods: {
      async initializeSession() {
        console.log(this.token);
        console.log(this.sessionId);
        const session = OT.initSession(this.opentok_api_key, this.sessionId);
        session.on("streamCreated", function(event) {
          session.subscribe(event.stream, "subscriber", {
            insertMode: "append",
            width: "100%",
            height: "100%"
          });
        });
        var publisher = OT.initPublisher("publisher", {
          insertMode: "append",
          width: "100%",
          height: "100%"
        });
        session.connect(this.token, function(error) {
          if (error) {
            this.handleError(error);
          } else {
            session.publish(publisher);
          }
        });
      },
      handleError(error) {
        if (error) {
          alert(error.message);
        }
      },
    },
  };

</script>

<style scoped>

  #videos {
    /* position: relative; */
    width: 100%;
    height: 100%;
    margin-left: auto;
    margin-right: auto;
  }

  #subscriber {
    /* position: absolute;
    left: 0;
    top: 0; */
    width: 360px;
    height: 240px;
    /* z-index: 10; */
    border: 3px solid white;
    border-radius: 3px;
  }

  #publisher {
    /* position: absolute; */
    width: 360px;
    height: 240px;
    /* bottom: 10px;
    left: 10px;
    z-index: 100; */
    border: 3px solid white;
    border-radius: 3px;
  }

</style>