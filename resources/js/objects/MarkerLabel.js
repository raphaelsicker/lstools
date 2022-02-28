export default class MarkerLabel {
    static new(
        text = '#E32831',
        color = '#fff'
    ) {
        return {
            text: text,
            fontFamily: 'arial',
            fontWeight: '900',
            color: color
        }
    }
}
