<template>
  <div id="app" class="flex flex-col h-screen bg-blue-100 p-5 overflow-hidden">
    <div
      class="font-mono w-full p-4 bg-white shadow rounded mb-5 font-bold text-3xl underline"
    >VueTemplater</div>
    <div class="font-mono">
      <textarea
        onkeydown="if(event.keyCode===9){var v=this.value,s=this.selectionStart,e=this.selectionEnd;this.value=v.substring(0, s)+'\t'+v.substring(e);this.selectionStart=this.selectionEnd=s+1;return false;}"
        placeholder="paste tab-separated values here. Headers will be used as placeholder in the input textbox below..."
        class="w-full bg-black rounded text-white p-4 font-mono text-sm"
        v-model="rawTsvData"
        rows="10"
      ></textarea>
    </div>

    <div class="flex-grow h-2 flex items-stretch p-5 shadow bg-white rounded">
      <div class="flex-grow flex flex-col rounded font-mono">
        <div class="w-full overflow-y-scroll rounded m-0">
          <tinymce
            id="d1"
            :toolbar1="toolbar1"
            :toolbar2="toolbar2"
            :plugins="plugins"
            v-model="mailTemplate"
          ></tinymce>
        </div>
        <div class="flex flex-row p-2 font-mono text-sm w-full">
          <input
            v-model="postEndpoint"
            type="text"
            class="p-2 flex-grow self-stretch w-full rounded border mr-4"
            placeholder="enter endpoint here"
          />
          <input
            v-model="uuid"
            type="text"
            class="p-2 flex-grow self-stretch w-full rounded border mr-4"
            placeholder="enter header for uuid"
          />
          <button
            @click="sendCustomizedEmail()"
            class="font-serif self-stretch text-xl w-full border-2 bg-blue-100 hover:bg-blue-500 text-blue-900 hover:text-white p-3 rounded"
          >{{button_text}}</button>
        </div>
      </div>
      <div
        class="flex-grow relative overflow-hidden bg-blue-100 text-xs shadow font-sans border rounded ml-5 font-mono"
      >
        <div class="bg-blue-900 text-white p-4">
          Render row #:
          <input
            type="number"
            min="1"
            @keyup="renderThisRow"
            class="text-blue-900 border p-2 w-1/2"
            placeholder="enter the row to render"
          />
        </div>
        <div
          v-html="builtSampleOutput"
          class="absolute h-full w-full overflow-y-auto bg-blue-100 text-grey-300 text-xs font-sans rounded p-4 font-mono"
        ></div>
      </div>
    </div>
  </div>
</template>

<script>
import tinymce from "vue-tinymce-editor";
import { debuglog } from "util";
import Faker from "fakergem";

//TODO: use sweetlaert for popoups and submit this to "built with sweetlaert"

export default {
  name: "app",
  components: {
    tinymce
  },
  data() {
    return {
      postEndpoint: "",
      uuid: "email",
      randomRenderedRow: 1,
      rawTsvData: `sn\tname\temail\tphone\taddress\n`,
      mailTemplate: `<br><br>Hello,<b><i>{{name}}</i></b>.<br><br>Can we call you on <b><u>{{phone}}</u></b>?<br><br><br><br><br><br><br><br><br>`,
      toolbar1:
        " bold italic forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | removeformat",
      toolbar2: "",
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "template paste textcolor colorpicker textpattern imagetools toc help emoticons hr codesample"
      ],
      builtSampleOutput: "",
      uuid_index: 0,
      button_text: "Submit"
    };
  },
  mounted: function() {
    this.uuid_index = this.tsvHeaders.indexOf(this.uuid);
    //now randomly generate stuff
    let data = this.rawTsvData;
    for (let index = 1; index <= 50; index++) {
      // `sn\tname\temail\tphone\taddress\n`,
      data += `${index}\t${Faker.Name.name()}\t${Faker.Internet.email()}\t${Faker.PhoneNumber.cellPhone()}\t${Faker.Address.streetAddress()}\n`;
    }
    this.rawTsvData = data;

    //display sample
    this.builtSampleOutput = this.buildMessageFromTemplate(
      this.splittedTrimmedDataRows[1].split("\t"),
      this.mailTemplate,
      this.tsvHeaders
    );
  },
  computed: {
    splittedTrimmedDataRows: function() {
      return this.trimmedTsvData.split("\n");
    },
    trimmedTsvData: {
      get: function() {
        return this.rawTsvData.trim();
      },
      set: function() {}
    },
    tsvHeaders: function() {
      //array of headers: from the first row
      if (
        this.splittedTrimmedDataRows &&
        this.splittedTrimmedDataRows.length >= 1
      ) {
        return this.splittedTrimmedDataRows[0].split("\t");
      }
      return [];
    }
  },
  watch: {
    mailTemplate: function() {
      // debugger;
      this.randomRenderedRow = getRandomIntInclusive(
        1,
        this.splittedTrimmedDataRows.length - 1
      );

      let tmp = this.buildMessageFromTemplate(
        //TODO: check that index exists
        this.splittedTrimmedDataRows[this.randomRenderedRow].split("\t"),
        this.mailTemplate,
        this.tsvHeaders
      );
      this.builtSampleOutput = tmp;
    },

    randomRenderedRow: function() {
      //just disrupt, so that we get stuff to trigger
      this.mailTemplate = this.mailTemplate + " ";
    }
  },
  methods: {
    renderThisRow: function(event) {
      // debugger;
      this.builtSampleOutput = this.buildMessageFromTemplate(
        this.splittedTrimmedDataRows[event.target.value].split("\t"),
        this.mailTemplate,
        this.tsvHeaders
      );
    },
    buildMessageFromTemplate: function(
      rawStringArray,
      template,
      replacementHeaders
    ) {
      var finalBuild = template;
      try {
        //replace all headers with it's moustache in template
        for (let index = 0; index < replacementHeaders.length; index++) {
          let replacement = new RegExp(
            `{{${replacementHeaders[index]}}}`,
            "gi"
          );
          finalBuild = finalBuild.replace(replacement, rawStringArray[index]);
        }
      } catch (error) {
        //sample thing we catch here is when rawStringArray and replacementHeaders erroneously have diffrent lengths
      }
      return finalBuild;
    },
    getAllCustomizedEmails: function() {
      //loop through the pasted csv lines
      //pass them through the formatter
      var customizedEmails = {};

      //start from index 1: skip the headers
      for (
        let index = 1;
        index < this.splittedTrimmedDataRows.length;
        index++
      ) {
        // debugger;
        let dataRowArray = this.splittedTrimmedDataRows[index].split("\t");
        customizedEmails[
          dataRowArray[this.uuid_index]
        ] = this.buildMessageFromTemplate(
          dataRowArray,
          this.mailTemplate,
          this.tsvHeaders
        );
      }

      return customizedEmails;
    },
    sendCustomizedEmail: function(endpoint) {
      let all = this.getAllCustomizedEmails();
      // debugger;
      // format for display
      let demacation = "--------------------";
      this.builtSampleOutput = "";
      Object.keys(all).forEach((key, index) => {
        // debugger;
        this.builtSampleOutput += `<br>${key}<br>${demacation}<br>${all[key]}<br><br>`;
      });

      // TODO: ensure no sending session going on - singleton sending
      console.log("sending to", this.postEndpoint, all);
      this.button_text = "Sending...";
      postData(this.postEndpoint, all)
        .then(data => console.log(data)) // JSON from `response.json()` call
        .catch(error => console.error(error))
        .finally(() => (this.button_text = "Submit"));
    }
  }
};

function postData(url, data) {
  // Default options are marked with *
  return fetch(url, {
    body: JSON.stringify(data), // must match 'Content-Type' header
    cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
    credentials: "same-origin", // include, same-origin, *omit
    headers: {
      "user-agent": "Mozilla/4.0 MDN Example",
      "content-type": "application/json",
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
        ? document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content")
        : ""
    },
    method: "POST", // *GET, POST, PUT, DELETE, etc.
    mode: "cors", // no-cors, cors, *same-origin
    redirect: "follow", // manual, *follow, error
    referrer: "no-referrer" // *client, no-referrer
  }).then(response => response.text()); // parses response to JSON
}

function getRandomIntInclusive(min, max) {
  // debugger
  min = Math.ceil(min);
  max = Math.floor(max);
  return Math.floor(Math.random() * (max - min + 1)) + min; //The maximum is inclusive and the minimum is inclusive
}
</script>

<style>
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}

.mce-edit-area,
iframe {
  height: 100% !important;
}

.mce-container-body.mce-stack-layout {
  height: 70% !important;
}
</style>
