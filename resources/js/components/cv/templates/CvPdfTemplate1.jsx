import React from 'react';
import { Document, Page, Text, View, StyleSheet, Font } from '@react-pdf/renderer';

// Register fonts
Font.register({
  family: 'Lato',
  fonts: [
    { src: 'https://fonts.gstatic.com/s/lato/v23/S6uyw4BMUTPHjx4wXg.ttf', fontWeight: 'normal' },
    { src: 'https://fonts.gstatic.com/s/lato/v23/S6u9w4BMUTPHh6UVSwiPHA.ttf', fontWeight: 'bold' }
  ]
});

// Create styles
const styles = StyleSheet.create({
  page: {
    fontFamily: 'Lato',
    padding: 0,
    flexDirection: 'row',
  },
  sidebar: {
    width: '30%',
    backgroundColor: '#1F2937',
    color: 'white',
    padding: 20,
  },
  main: {
    width: '70%',
    padding: 20,
  },
  header: {
    alignItems: 'center',
    marginBottom: 20,
  },
  name: {
    fontSize: 20,
    fontWeight: 'bold',
    marginBottom: 5,
    textTransform: 'uppercase',
  },
  title: {
    fontSize: 14,
    color: '#D1D5DB',
    textAlign: 'center',
  },
  contactInfo: {
    fontSize: 10,
    marginTop: 15,
  },
  contactItem: {
    marginBottom: 8,
  },
  sidebarSection: {
    marginTop: 25,
  },
  mainSection: {
    marginBottom: 20,
  },
  sectionTitle: {
    fontSize: 14,
    fontWeight: 'bold',
    marginBottom: 10,
    borderBottomWidth: 1,
    borderBottomColor: '#E5E7EB',
    borderBottomStyle: 'solid',
    paddingBottom: 5,
  },
  sidebarSectionTitle: {
    fontSize: 14,
    fontWeight: 'bold',
    marginBottom: 10,
    borderBottomWidth: 1,
    borderBottomColor: '#4B5563',
    borderBottomStyle: 'solid',
    paddingBottom: 5,
  },
  skill: {
    fontSize: 10,
    marginBottom: 6,
  },
  item: {
    marginBottom: 8,
    fontSize: 10,
  }
});

const CvPdfTemplate2 = ({ formData }) => {
  // Helper function to parse multi-line text into arrays
  const parseTextToArray = (text) => {
    return text.split(/\r?\n/).filter(item => item.trim() !== '');
  };

  const skills = formData.skills.split(',').map(skill => skill.trim()).filter(skill => skill !== '');
  const experiences = parseTextToArray(formData.experience);
  const education = parseTextToArray(formData.education);
  const certifications = parseTextToArray(formData.certifications);
  const languages = parseTextToArray(formData.languages);
  const projects = parseTextToArray(formData.projects);

  return (
    <Document>
      <Page size="A4" style={styles.page}>
        {/* Sidebar */}
        <View style={styles.sidebar}>
          <View style={styles.header}>
            <Text style={styles.name}>{formData.name || 'Your Name'}</Text>
            <Text style={styles.title}>{formData.titre || 'Your Job Title'}</Text>
          </View>

          <View style={styles.contactInfo}>
            <Text style={styles.contactItem}>{formData.email || 'your.email@example.com'}</Text>
            <Text style={styles.contactItem}>{formData.phone || '+212 6XX-XXXXXX'}</Text>
          </View>

          {skills.length > 0 && (
            <View style={styles.sidebarSection}>
              <Text style={styles.sidebarSectionTitle}>Skills</Text>
              {skills.map((skill, index) => (
                <Text key={index} style={styles.skill}>
                  • {skill}
                </Text>
              ))}
            </View>
          )}

          {languages.length > 0 && (
            <View style={styles.sidebarSection}>
              <Text style={styles.sidebarSectionTitle}>Languages</Text>
              {languages.map((lang, index) => (
                <Text key={index} style={styles.skill}>
                  • {lang}
                </Text>
              ))}
            </View>
          )}

          {certifications.length > 0 && (
            <View style={styles.sidebarSection}>
              <Text style={styles.sidebarSectionTitle}>Certifications</Text>
              {certifications.map((cert, index) => (
                <Text key={index} style={styles.skill}>
                  • {cert}
                </Text>
              ))}
            </View>
          )}
        </View>

        {/* Main Content */}
        <View style={styles.main}>
          {experiences.length > 0 && (
            <View style={styles.mainSection}>
              <Text style={styles.sectionTitle}>Professional Experience</Text>
              {experiences.map((exp, index) => (
                <Text key={index} style={styles.item}>
                  {exp}
                </Text>
              ))}
            </View>
          )}

          {education.length > 0 && (
            <View style={styles.mainSection}>
              <Text style={styles.sectionTitle}>Education</Text>
              {education.map((edu, index) => (
                <Text key={index} style={styles.item}>
                  {edu}
                </Text>
              ))}
            </View>
          )}

          {projects.length > 0 && (
            <View style={styles.mainSection}>
              <Text style={styles.sectionTitle}>Projects</Text>
              {projects.map((proj, index) => (
                <Text key={index} style={styles.item}>
                  {proj}
                </Text>
              ))}
            </View>
          )}
        </View>
      </Page>
    </Document>
  );
};

export default CvPdfTemplate2;