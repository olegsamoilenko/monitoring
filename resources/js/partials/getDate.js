export default {
  data() {
    return {
      optionsDate: {
        year: 'numeric',
        month: 'numeric',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        timezone: 'UTC',
      },
    }
  },
  methods: {
    getDate(date) {
      return new Intl.DateTimeFormat('ua-UA', this.optionsDate).format(new Date(date))
    },
  }
}