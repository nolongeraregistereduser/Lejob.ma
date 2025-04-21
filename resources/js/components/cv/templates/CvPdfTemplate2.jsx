import React from 'react';
import { Document, Page, Text, View, StyleSheet } from '@react-pdf/renderer';

// Create styles for Classic template
const styles = StyleSheet.create({
  page: {
    flexDirection: 'row',
    backgroundColor: 'white',
    fontFamily: 'Helvetica',
  },
  // Sidebar styles
  sidebar: {
    width: '35%',
    backgroundColor: '#1f2937',
    color: 'white',
    padding: 20,
    height: '100%',
  },
  profileSection: {
    marginBottom: 20,
    paddingBottom: 10,
    borderBottom: '1px solid #4b5563',
  },
  profileName: {
    fontSize: 20,
    fontWeight: 'bold',
    marginBottom: 5,
  },
  profileTitle: {
    fontSize: 14,
    marginBottom: 10,
    color: '#d1d5db',
  },
  sidebarSection: {
    marginBottom: 15,
  },
  sidebarSectionTitle: {
    fontSize: 14,
    fontWeight: 'bold',
    marginBottom: 8,
    paddingBottom: 5,
    borderBottom: '1px solid #4b5563',
  },
  contactItem: {
    fontSize: 10,
    marginBottom: 5,
    color: '#d1d5db',
  },
  sidebarItem: {
    fontSize: 10,
    marginBottom: 5,
    color: '#d1d5db',
  },
  
  // Main content styles
  content: {
    width: '65%',
    padding: 20,
  },
  contentSection: {
    marginBottom: 20,
  },
  contentSectionTitle: {
    fontSize: 16,
    fontWeight: 'bold',
    marginBottom: 10,
    borderBottom: '1px solid #e5e7eb',
    paddingBottom: 5,
  },
  contentItem: {
    fontSize: 11,
    marginBottom: 8,
  },
});

// Component
const CvPdfTemplate2 = ({ formData }) => {
  // Helper function to parse text into arrays
  const parseTextToArray = (text) => {
    return text ? text.split(/\r?\n/).filter(item => item.trim() !== '') : [];
  };

  const skills = formData.skills ? formData.skills.split(',').map(skill => skill.trim()).filter(skill => skill !== '') : [];
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
          <View style={styles.profileSection}>
            <Text style={styles.profileName}>{formData.name || 'Your Name'}</Text>
            <Text style={styles.profileTitle}>{formData.titre || 'Your Job Title'}</Text>
          </View>
          
          <View style={styles.sidebarSection}>
            <Text style={styles.sidebarSectionTitle}>Contact</Text>
            <Text style={styles.contactItem}>{formData.email || 'your.email@example.com'}</Text>
            <Text style={styles.contactItem}>{formData.phone || '+212 6XX-XXXXXX'}</Text>
          </View>
          
          {skills.length > 0 && (
            <View style={styles.sidebarSection}>
              <Text style={styles.sidebarSectionTitle}>Skills</Text>
              {skills.map((skill, index) => (
                <Text key={index} style={styles.sidebarItem}>• {skill}</Text>
              ))}
            </View>
          )}
          
          {languages.length > 0 && (
            <View style={styles.sidebarSection}>
              <Text style={styles.sidebarSectionTitle}>Languages</Text>
              {languages.map((lang, index) => (
                <Text key={index} style={styles.sidebarItem}>• {lang}</Text>
              ))}
            </View>
          )}
          
          {certifications.length > 0 && (
            <View style={styles.sidebarSection}>
              <Text style={styles.sidebarSectionTitle}>Certifications</Text>
              {certifications.map((cert, index) => (
                <Text key={index} style={styles.sidebarItem}>• {cert}</Text>
              ))}
            </View>
          )}
        </View>
        
        {/* Main Content */}
        <View style={styles.content}>
          {experiences.length > 0 && (
            <View style={styles.contentSection}>
              <Text style={styles.contentSectionTitle}>Professional Experience</Text>
              {experiences.map((exp, index) => (
                <Text key={index} style={styles.contentItem}>
                  {exp}
                </Text>
              ))}
            </View>
          )}

          {education.length > 0 && (
            <View style={styles.contentSection}>
              <Text style={styles.contentSectionTitle}>Education</Text>
              {education.map((edu, index) => (
                <Text key={index} style={styles.contentItem}>
                  {edu}
                </Text>
              ))}
            </View>
          )}

          {projects.length > 0 && (
            <View style={styles.contentSection}>
              <Text style={styles.contentSectionTitle}>Projects</Text>
              {projects.map((proj, index) => (
                <Text key={index} style={styles.contentItem}>
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