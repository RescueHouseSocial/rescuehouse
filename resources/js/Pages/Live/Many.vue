<template>
  <div id="Many">
    <div id="publisher" class="mx-2 my-4 p-4 grid grid-cols-1 gap-4 bg-gray-50 rounded-lg shadow"></div>
    <!-- <div id="subscriber" class="mx-2 my-4 p-4 grid grid-cols-1 md:grid-cols-4 gap-4 bg-gray-50 rounded-lg shadow"></div> -->
    <div id="subscriber" :class="[attendeeCount === 4 ? 'md:grid-cols-2' : (attendeeCount === 2 ? 'md:grid-cols-2' : (attendeeCount === 3 ? 'md:grid-cols-3' : (attendeeCount === 6 ? 'md:grid-cols-3' : 'md:grid-cols-4'))), 'grid', 'grid-cols-2', 'gap-2', 'my-4']">
      <!-- <div v-for="index in attendeeCount" :key="index" class="items-center bg-gray-50 rounded-lg shadow">
        <div class="min-h-80">
          <div class="bg-black text-white w-full h-48 rounded-t-lg">
            video
          </div>
        </div>
      </div> -->
    </div>
  </div>
</template>

<script>

  export default {
    name: "DynamicLiveSession",
    props: ["opentok_api_key", "sessionId", "token"],
    data() {
      return {
        attendeeCount: 12,
      };
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
            const innerDiv = document.createElement("div");
            innerDiv.classList.add("min-h-80");
            innerDiv.classList.add("w-full");
            // innerDiv.classList.add("h-48");
            innerDiv.classList.add("rounded-t-lg");
            innerDiv.appendChild(videoElement);
            document.getElementById("subscriber").appendChild(innerDiv);
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