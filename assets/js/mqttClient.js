const clientId = "mqttjs_" + Math.random().toString(16).substr(2, 4);
const username = "h8rgunid";
const password = "Binkquest!8";
const host =
	"wss://" +
	username +
	":" +
	password +
	"@07d99c71818c422fbaa20482b7c139eb.s2.eu.hivemq.cloud:8884/mqtt";

const topic_datetime = "nodemcu/iotw/datetime";
const topic_configurelc = "nodemcu/iotw/configurelc";
const topic_configuretime = "nodemcu/iotw/configuretime";

const options = {
	keepalive: 30,
	clientId: clientId,
	protocolId: "MQTT",
	protocolVersion: 4,
	clean: true,
	reconnectPeriod: 1000,
	connectTimeout: 30 * 1000,
	will: {
		topic: "WillMsg",
		payload: "Connection Closed abnormally..!",
		qos: 0,
		retain: false,
	},
	rejectUnauthorized: false,
};

console.log("connecting mqtt client");
const client = mqtt.connect(host, options);

client.on("error", (err) => {
	console.log("Connection error: ", err);
	client.end();
});

client.on("reconnect", () => {
	console.log("Reconnecting...");
});

client.on("connect", () => {
	console.log("Client connected:" + clientId);
	client.subscribe(topic_datetime);
});

client.on("message", (topic, message, packet) => {
	console.log(
		"Received Message: " + message.toString() + "\nOn topic: " + topic
	);
});

client.on("close", () => {
	console.log(clientId + " disconnected");
});

function publish(topic, data_pub) {
	client.publish(topic, data_pub, {
		qos: 0,
		retain: false,
	});
}

var start, level;
client.on("message", (topic, message, packet) => {
	if (topic == topic_datetime) {
		document.getElementById("datetime").innerHTML = message.toString();

		if (
			document.getElementById("statusIcon").classList.contains("text-danger")
		) {
			document.getElementById("statusIcon").classList.remove("text-danger");
			document.getElementById("statusIcon").classList.add("text-success");
			document.getElementById("status").innerHTML = "IoT - Connected";
		}
	}
});

function sendId(user_id = null, lc = null) {
	if (user_id == null && lc == null) {
		publish(topic_configurelc, "delete_all");
	} else {
		// if(lc) {
		// 	publish(topic_configurelc, "delete:" + user_id + ":" + name);

		// 	setTimeout(function(){
		// 		$('#dellc-' + user_id).prop('disabled', true)
		// 		if(document.getElementById("dellc-" + user_id).classList.contains('btn-outline-danger')) {
		// 			document.getElementById("dellc-" + user_id).classList.remove('btn-outline-danger');
		// 			document.getElementById("dellc-" + user_id).classList.add('btn-secondary');
		// 			document.getElementById("dellc-" + user_id).innerHTML = "Deleting..."
		// 		}
		// 	}, 100);

		// 	setTimeout(function(){
		// 		document.getElementById("dellc-" + user_id).innerHTML = "Deleted"
		// 	}, 3000);
		// } else {
			console.log(user_id)
		publish(topic_configurelc, "id=" + user_id);

		setTimeout(function () {
			$("#setlc-" + user_id).prop("disabled", true);
			if (
				document
					.getElementById("setlc-" + user_id)
					.classList.contains("btn-outline-info")
			) {
				document
					.getElementById("setlc-" + user_id)
					.classList.remove("btn-outline-info");
				document
					.getElementById("setlc-" + user_id)
					.classList.add("btn-secondary");
				document.getElementById("setlc-" + user_id).innerHTML = "Enrolling...";
			}
		}, 100);

		setTimeout(function () {
			$("#btn_enroll-" + user_id).prop("disabled", false);
			$("#btn_enroll_dismiss-" + user_id).prop("disabled", false);
			document.getElementById("btn_enroll-" + user_id).innerHTML = "Reload Now";
			document.getElementById("btn_enroll_dismiss-" + user_id).innerHTML =
				"Reload Later";
			document.getElementById("setlc-" + user_id).innerHTML = "Enrolled";

			clearInterval(countdown);
		}, 5000);

		var x = 5;
		const countdown = setInterval(function () {
			--x;
			document.getElementById("btn_enroll-" + user_id).innerHTML =
				"Enrolling (" + x + ")...";
			document.getElementById("btn_enroll_dismiss-" + user_id).innerHTML =
				"Enrolling (" + x + ")...";
		}, 1000);
	}
	// }
}

function configureTime() {
	var time_in_a = document.getElementById("time_in_a").value;
	var time_in_b = document.getElementById("time_in_b").value;
	var time_out_a = document.getElementById("time_out_a").value;
	var time_out_b = document.getElementById("time_out_b").value;

	publish(
		topic_configuretime,
		time_in_a + "|" + time_in_b + "|" + time_out_a + "|" + time_out_b
	);
}
