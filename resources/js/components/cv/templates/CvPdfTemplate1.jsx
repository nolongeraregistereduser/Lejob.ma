import React from 'react';
import { Document, Page, Text, View, StyleSheet } from '@react-pdf/renderer';

// Création des styles
const styles = StyleSheet.create({
  page: {
    padding: 30,
    fontFamily: 'Helvetica',
  },
  header: {
    backgroundColor: '#1E40AF',
    color: 'white',
    padding: 20,
    marginBottom: 20,
  },
  name: {
    fontSize: 24,
    marginBottom: 5,
  },
  title: {
    fontSize: 16,
    marginBottom: 10,
  },
  contactInfo: {
    fontSize: 12,
    marginTop: 5,
  },
  contactItem: {
    marginBottom: 3,
  },
  section: {
    marginBottom: 20,
  },
  sectionTitle: {
    fontSize: 16,
    marginBottom: 10,
    borderBottom: '1px solid #1E40AF',
    paddingBottom: 5,
  },
  item: {
    marginBottom: 8,
    fontSize: 11,
  },
  skillsContainer: {
    flexDirection: 'row',
    flexWrap: 'wrap',
    marginBottom: 5,
  },
  skill: {
    backgroundColor: '#DBEAFE',
    padding: 5,
    marginRight: 5,
    marginBottom: 5,
    fontSize: 10,
    borderRadius: 3,
  },
});

// Composant
const CvPdfTemplate1 = ({ formData }) => {
  // Fonction d'aide pour analyser le texte en tableaux
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
        <View style={styles.header}>
          <Text style={styles.name}>{formData.name || 'Votre Nom'}</Text>
          <Text style={styles.title}>{formData.titre || 'Votre Poste'}</Text>
          <View style={styles.contactInfo}>
            <Text style={styles.contactItem}>{formData.email || 'votre.email@example.com'}</Text>
            <Text style={styles.contactItem}>{formData.phone || '+212 6XX-XXXXXX'}</Text>
          </View>
        </View>

        {skills.length > 0 && (
          <View style={styles.section}>
            <Text style={styles.sectionTitle}>Compétences</Text>
            <View style={styles.skillsContainer}>
              {skills.map((skill, index) => (
                <Text key={index} style={styles.skill}>{skill}</Text>
              ))}
            </View>
          </View>
        )}

        {experiences.length > 0 && (
          <View style={styles.section}>
            <Text style={styles.sectionTitle}>Expérience</Text>
            {experiences.map((exp, index) => (
              <Text key={index} style={styles.item}>{exp}</Text>
            ))}
          </View>
        )}

        {education.length > 0 && (
          <View style={styles.section}>
            <Text style={styles.sectionTitle}>Formation</Text>
            {education.map((edu, index) => (
              <Text key={index} style={styles.item}>{edu}</Text>
            ))}
          </View>
        )}

        {certifications.length > 0 && (
          <View style={styles.section}>
            <Text style={styles.sectionTitle}>Certifications</Text>
            {certifications.map((cert, index) => (
              <Text key={index} style={styles.item}>{cert}</Text>
            ))}
          </View>
        )}

        {languages.length > 0 && (
          <View style={styles.section}>
            <Text style={styles.sectionTitle}>Langues</Text>
            {languages.map((lang, index) => (
              <Text key={index} style={styles.item}>{lang}</Text>
            ))}
          </View>
        )}

        {projects.length > 0 && (
          <View style={styles.section}>
            <Text style={styles.sectionTitle}>Projets</Text>
            {projects.map((proj, index) => (
              <Text key={index} style={styles.item}>{proj}</Text>
            ))}
          </View>
        )}
      </Page>
    </Document>
  );
};

export default CvPdfTemplate1;