import { defineStore } from 'pinia'
import { merge, mapValues } from 'lodash'

export const useOpenSectionsStore = defineStore('open-sections', {
  state: () => {
    return {
      openAll: true,
      openSections: {}
    }
  },
  actions: {
    setOpenSections (sections) {
      const incomingSections = {}

      sections.forEach((section) => {
        incomingSections[section.id] = this.openAll
      })

      this.openSections = merge(incomingSections, this.openSections)
    },
    toggleAll () {
      this.openAll = !this.openAll

      this.openSections = mapValues(this.openSections, o => this.openAll)
    }
  }
})