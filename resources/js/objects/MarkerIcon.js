import {faLocationPin, faLocationDot} from "@fortawesome/free-solid-svg-icons";

export default class MarkerIcon {
    static new(color = '#007bff', type = 'pin') {
        color = color ?? '#007bff'
        const location = type === 'pin' ? faLocationPin : faLocationDot

        return {
            path: location.icon[4],
            labelOrigin: new google.maps.Point(location.icon[0] / 2, 200),
            anchor: new google.maps.Point(location.icon[0] / 2, location.icon[1]),
            fillColor: color,
            fillOpacity: 1,
            strokeWeight: 0,
            scale: 0.075
        }
    }
}
