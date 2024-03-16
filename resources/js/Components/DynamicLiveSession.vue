<template>
  <div id="DynamicLiveSession">
    <div id="publisher" class="mx-2 my-4 p-4 grid grid-cols-1 gap-4 bg-gray-50 rounded-lg shadow"></div>
    <div id="subscriber" class="mx-2 my-4 p-4 grid grid-cols-1 md:grid-cols-4 gap-4 bg-gray-50 rounded-lg shadow"></div>
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
        const session = OT.initSession(this.opentok_api_key, this.sessionId);
        session.on('streamCreated', (event) => {
          const subscriberOptions = {
            insertDefaultUI: false,
          };
          const subscriber = session.subscribe(event.stream, subscriberOptions);
          subscriber.on("videoElementCreated", function(event) {
            const videoElement = event.element;
            videoElement.classList.add("h-52");
            videoElement.classList.add("w-full");
            document.getElementById("subscriber").appendChild(videoElement);
          });
        });
        var publisher = OT.initPublisher();
        const publisherOptions = {
          insertDefaultUI: false,
        };
        publisher = OT.initPublisher(publisherOptions);
        publisher.on("videoElementCreated", function(event) {
          const videoElement = event.element;
          videoElement.classList.add("h-52");
          videoElement.classList.add("w-full");
          document.getElementById("publisher").appendChild(videoElement);
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