const video = document.getElementById('video')

// Loading all the face-api models that I will be using, then run my startVideo function
Promise.all([
    faceapi.nets.tinyFaceDetector.loadFromUri('/models'),
    // faceapi.nets.faceLandmark68Net.loadFromUri('/models'),
    faceapi.nets.faceExpressionNet.loadFromUri('/models'),
    faceapi.nets.ssdMobilenetv1.loadFromUri('/models')
]).then(startVideo())

// Function that starts the live stream from the users webcam
function startVideo() {
    navigator.getUserMedia(
        { video: {} },
        stream => video.srcObject = stream,
        error => console.error(error)
    )
}

video.addEventListener('play', () => {
    // creating a canvas for face detection
    const canvas = faceapi.createCanvasFromMedia(video)
    //adding the canvas in the element with id of 'detection'
    document.querySelector('#detection').append(canvas)

    // Size of the canvas, then match the canvas location with the users face
    const displaySize = { width: video.width, height: video.height }
    faceapi.matchDimensions(canvas, displaySize)

    // Variable for number of times a face has not been detected
    var noFaceDetection = 0;
    // Variable for number of times a face has been detected
    var faceDetected = 0;
    // Variable to store the duration of no face detection
    var timeWithNoDetection = 0;

    var userSad = 0;
    var timeWithNoDetection = 0;

    // Variable for speech to audio using a web api
    var msg = new SpeechSynthesisUtterance();

    // running the face detection at specified intervals (in milliseconds)
    setInterval(async () => {
        // variable to detec all faces from the video web cam using the three models that we called earlier and displaying landmarks and expressions
        const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions()).withFaceExpressions()

        // DETECTING FACIAL EXPRESSION AND DISPLAYING THE RESULT
        const detectionWithExpressions = await faceapi.detectSingleFace(video).withFaceExpressions()

        // If statement checks if a face has been detecting by checking the length of the array returned by 'detections'
        console.log(detections)
        if (detections.length != 0) {
            faceDetected++;
            // looping through all the different expressions and displaying the reuslt of the users facial expression
            for (key in detectionWithExpressions.expressions) {
                var value = detectionWithExpressions.expressions[key];

                if (value >= 0.6 && value <= 1) {
                    if (key == 'happy') {
                        document.getElementById("expressionStatus").style.color = "green";
                        document.getElementById('expressionStatus').innerHTML = key;
                    } else if (key == 'neutral') {
                        document.getElementById("expressionStatus").style.color = "gold";
                        document.getElementById('expressionStatus').innerHTML = key;
                    } else if (key == 'angry') {
                        document.getElementById("expressionStatus").style.color = "red";
                        document.getElementById('expressionStatus').innerHTML = key;
                    } else if (key == 'sad') {
                        userSad++;
                        document.getElementById("expressionStatus").style.color = "orange";
                        document.getElementById('expressionStatus').innerHTML = key;
                        if (userSad == 10) {
                            msg.text = "Don't be sad, cheer up you are nearly done";
                            window.speechSynthesis.speak(msg);
                            userSad = 0;
                        }
                    }
                }
            }
        } else {
            // if no face detected, noFaceDetection and timeWithNoDetection are incremented by 1
            noFaceDetection++;
            timeWithNoDetection++;
            document.getElementById("expressionStatus").style.color = "black";
            document.getElementById('expressionStatus').innerHTML = 'No face has been detected';
        }

        // if face has always been detected then user has 100% concentration
        if (noFaceDetection == 0) {
            concentration = 100;
            document.getElementById('concentrationLevel').innerHTML = concentration;
            document.getElementById('concentrationLevel1').innerHTML = '% ' + concentration;
        } else {
            concentration = parseFloat((faceDetected / noFaceDetection) * 100).toFixed(1);
            if (concentration > 100) {
                concentration = 100;
            } else if (concentration < 0) {
                concentration = 0
            }
            document.getElementById('concentrationLevel').innerHTML = '% ' + concentration;
            document.getElementById('concentrationLevel1').innerHTML = '% ' + concentration;

            // if the user has not been detected from at least 10 seconds then audio will be displayed to interact with the user and timeWithNoDetection is reset to 0
            if (timeWithNoDetection == 10) {
                msg.text = "Please pay attention you are nearly there";
                window.speechSynthesis.speak(msg);
                timeWithNoDetection = 0;
            }
        }
        // creating the canvas size, drawing the users landmarks, expression on the canvas
        const resizedDetections = faceapi.resizeResults(detections, displaySize)
        canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height)
        faceapi.draw.drawDetections(canvas, resizedDetections)
        // faceapi.draw.drawFaceLandmarks(canvas, resizedDetections)
        faceapi.draw.drawFaceExpressions(canvas, resizedDetections)

    }, 2000)
})


